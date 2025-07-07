<?php

namespace HotelBooking\Facades;

define('DB_HOST', getenv('DB_HOST'));
define('DB_PORT', getenv('DB_PORT'));
define('DB_USER', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_NAME', getenv('DB_DATABASE'));

class DB
{
    // Connection
    protected static $connection;

    // Query builder state
    protected $table;
    protected $columns = '*';
    protected $wheres = [];
    protected $order = '';
    protected $limit = '';

    // Constructor (for builder)
    public function __construct($table = null)
    {
        $this->table = $table;
    }

    // Connect to database
    public static function connect()
    {
        if (!self::$connection) {
            try {
                self::$connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
                if (self::$connection->connect_error) {
                    die("Connection failed: " . self::$connection->connect_error);
                }
            } catch (\Exception $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    // Close connection
    public static function close()
    {
        if (self::$connection) {
            self::$connection->close();
            self::$connection = null;
        }
    }

    // Chọn table để bắt đầu truy vấn
    public static function table($table)
    {
        return new self($table);
    }

    // Select columns
    public function select($columns = '*')
    {
        $this->columns = $columns;
        return $this;
    }

    // Thêm điều kiện WHERE
    public function where($column, $operator, $value)
    {
        $conn = self::connect();
        $escaped = $conn->real_escape_string($value);
        self::close();
        $this->wheres[] = "$column $operator '$escaped'";
        return $this;
    }

    // Order by
    public function orderBy($column, $direction = 'ASC')
    {
        $this->order = "$column $direction";
        return $this;
    }

    // Limit
    public function limit($limit, $offset = null)
    {
        $this->limit = $offset !== null ? "$offset, $limit" : $limit;
        return $this;
    }

    // Lấy danh sách kết quả
    public function get()
    {
        $sql = "SELECT {$this->columns} FROM {$this->table}";
        if ($this->wheres) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }
        if ($this->joins) {
            $sql .= ' ' . implode(' ', $this->joins);
        }
        if ($this->order) {
            $sql .= ' ORDER BY ' . $this->order;
        }
        if ($this->limit) {
            $sql .= ' LIMIT ' . $this->limit;
        }
        return self::getListData($sql);
    }

    // Lấy kết quả đầu tiên
    public function first()
    {
        $sql = "SELECT {$this->columns} FROM {$this->table}";
        if ($this->wheres) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }
        if ($this->order) {
            $sql .= ' ORDER BY ' . $this->order;
        }
        $sql .= ' LIMIT 1';
        return self::getRowData($sql);
    }

    // Đếm số lượng bản ghi
    public function count()
    {
        $sql = "SELECT COUNT(*) as cnt FROM {$this->table}";
        if ($this->wheres) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }
        $row = self::getRowData($sql);
        return isset($row['cnt']) ? (int) $row['cnt'] : 0;
    }

    // Insert data
    public function insert($data)
    {
        $conn = self::connect();
        $cols = implode(", ", array_keys($data));
        $escaped = array_map([$conn, 'real_escape_string'], array_values($data));
        $vals = implode(", ", array_map(function ($v) {
            return "'" . $v . "'";
        }, $escaped));
        $sql = "INSERT INTO {$this->table} ($cols) VALUES ($vals)";
        $res = $conn->query($sql);
        self::close();
        return $res;
    }

    // Update data
    public function update($data)
    {
        $conn = self::connect();
        $set = [];
        foreach ($data as $col => $val) {
            $set[] = "$col = '" . $conn->real_escape_string($val) . "'";
        }
        $where = $this->wheres ? implode(' AND ', $this->wheres) : '';
        $sql = "UPDATE {$this->table} SET " . implode(', ', $set);
        if ($where) {
            $sql .= " WHERE $where";
        }
        $res = $conn->query($sql);
        self::close();
        return $res;
    }

    // Delete data
    public function delete()
    {
        $conn = self::connect();
        $where = $this->wheres ? implode(' AND ', $this->wheres) : '';
        $sql = "DELETE FROM {$this->table}";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $res = $conn->query($sql);
        self::close();
        return $res;
    }

    // Raw expression
    public static function raw($expression)
    {
        return $expression;
    }

    /**
     * Where raw (no escaping)
     */
    public function whereRaw($expression)
    {
        $this->wheres[] = $expression;
        return $this;
    }

    // Join clauses
    protected $joins = [];
    public function join($table, $first, $operator, $second)
    {
        $this->joins[] = "JOIN $table ON $first $operator $second";
        return $this;
    }

    public function leftJoin($table, $first, $operator, $second)
    {
        $this->joins[] = "LEFT JOIN $table ON $first $operator $second";
        return $this;
    }

    // Group by
    protected $groupBys = [];
    public function groupBy($columns)
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }
        $this->groupBys[] = $columns;
        return $this;
    }

    // Having
    protected $havings = [];
    public function having($column, $operator, $value)
    {
        $conn = self::connect();
        $escaped = $conn->real_escape_string($value);
        self::close();
        $this->havings[] = "$column $operator '$escaped'";
        return $this;
    }

    // Paginate results
    public function paginate($perPage, $page = 1)
    {
        $total = $this->count();
        $offset = ($page - 1) * $perPage;
        $data = $this->limit($perPage, $offset)->get();
        $lastPage = (int) ceil($total / $perPage);
        return [
            'data' => $data,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'lastPage' => $lastPage,
        ];
    }

    // Insert and get ID
    public function insertGetId($data)
    {
        $res = $this->insert($data);
        if ($res) {
            $conn = self::connect();
            $id = $conn->insert_id;
            self::close();
            return $id;
        }
        return null;
    }

    // Upsert (insert or update)
    public function upsert($data)
    {
        return $this->exists() ? $this->update($data) : $this->insert($data);
    }

    // Pluck values
    public function pluck($column, $key = null)
    {
        $rows = $this->get();
        $result = [];
        foreach ($rows as $row) {
            if ($key) {
                $result[$row[$key]] = $row[$column];
            } else {
                $result[] = $row[$column];
            }
        }
        return $result;
    }

    // Check existence
    public function exists()
    {
        return $this->count() > 0;
    }

    // Private helper: list
    private static function getListData($sql)
    {
        $conn = self::connect();
        $result = $conn->query($sql);
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
        self::close();
        return $data;
    }

    // Private helper: single row
    private static function getRowData($sql)
    {
        $conn = self::connect();
        $result = $conn->query($sql);
        $row = null;
        if ($result) {
            $row = $result->fetch_assoc();
            $result->free();
        }
        self::close();
        return $row;
    }
}
