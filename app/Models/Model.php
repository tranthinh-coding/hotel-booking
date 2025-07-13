<?php

namespace HotelBooking\Models;

use HotelBooking\Facades\DB;

abstract class Model
{
    /** Tên bảng */
    protected $table;

    /** Các cột/thuộc tính được phép gán hàng loạt, ghi đè trong lớp con */
    protected $attributes = [];

    /** Khóa chính */
    protected $primaryKey = 'id';

    /** Row data storage */
    public $data = [];

    // Get all records
    public static function all()
    {
        $instance = new static();
        $rows = DB::table($instance->table)
            ->select('*')
            ->get();

        $results = [];

        foreach ($rows as $row) {
            $model = new static();
            $model->data = $row;
            $results[] = $model;
        }

        return $results;
    }

    // Alias to find by primary key
    public static function find($id)
    {
        return static::getById($id);
    }

    // Get record by PK
    public static function getById($id)
    {
        $instance = new static();
        $row = DB::table($instance->table)
            ->where($instance->primaryKey, '=', $id)
            ->first();
        if (!$row) {
            return null;
        }
        $instance->data = $row;
        return $instance;
    }

    // Magic getter
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    // Magic setter (mass assignment safe)
    public function __set($name, $value)
    {
        if (in_array($name, $this->attributes)) {
            $this->data[$name] = $value;
        }
    }

    // Start a query builder for this model
    public static function query()
    {
        $instance = new static();
        return DB::table($instance->table);
    }

    // Raw where
    public static function whereRaw($expr)
    {
        return static::query()->whereRaw($expr);
    }

    // Where clause - returns a query builder that can chain to get()
    public static function where($column, $operator = '=', $value = null)
    {
        // If only 2 parameters, assume operator is '='
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }
        
        $instance = new static();
        $query = DB::table($instance->table)->select('*')->where($column, $operator, $value);
        
        // Return a custom object that can handle get()
        return new class($query, get_class($instance)) {
            private $query;
            private $modelClass;
            
            public function __construct($query, $modelClass) {
                $this->query = $query;
                $this->modelClass = $modelClass;
            }
            
            public function get() {
                $rows = $this->query->get();
                $results = [];
                
                foreach ($rows as $row) {
                    $model = new $this->modelClass();
                    $model->data = $row;
                    $results[] = $model;
                }
                
                return $results;
            }
            
            public function where($column, $operator = '=', $value = null) {
                if (func_num_args() === 2) {
                    $value = $operator;
                    $operator = '=';
                }
                $this->query->where($column, $operator, $value);
                return $this;
            }
        };
    }

    // Execute query and return model instances
    public static function get()
    {
        $instance = new static();
        $rows = DB::table($instance->table)->select('*')->get();

        $results = [];
        foreach ($rows as $row) {
            $model = new static();
            $model->data = $row;
            $results[] = $model;
        }
        
        return $results;
    }

    // Create a new record
    public static function create(array $data)
    {
        $instance = new static();
        $id = DB::table($instance->table)->insertGetId($data);
        $instance->data = $data;
        $instance->data[$instance->primaryKey] = $id;
        return $instance;
    }

    // Save current model (insert or update)
    public function save()
    {
        if (isset($this->data[$this->primaryKey])) {
            // update
            DB::table($this->table)
                ->where($this->primaryKey, '=', $this->data[$this->primaryKey])
                ->update($this->data);
        } else {
            // insert
            $id = DB::table($this->table)->insertGetId($this->data);
            $this->data[$this->primaryKey] = $id;
        }
        return $this;
    }

    // Delete current model
    public function delete()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return false;
        }
        DB::table($this->table)
            ->where($this->primaryKey, '=', $this->data[$this->primaryKey])
            ->delete();
        return true;
    }

    // Update attributes on existing model
    public function update(array $data)
    {
        DB::table($this->table)
            ->where($this->primaryKey, '=', $this->data[$this->primaryKey])
            ->update($data);
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    // Fill model data (mass assignment)
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->attributes)) {
                $this->data[$key] = $value;
            }
        }
        return $this;
    }

    // Convert to array
    public function toArray()
    {
        return $this->data;
    }

    // Convert to JSON
    public function toJson()
    {
        return json_encode($this->data);
    }
}