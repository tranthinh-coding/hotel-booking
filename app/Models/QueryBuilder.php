<?php

namespace HotelBooking\Models;

use HotelBooking\Facades\DB;

class QueryBuilder
{
    private $query;
    private $modelClass;

    public function __construct($query, $modelClass)
    {
        $this->query = $query;
        $this->modelClass = $modelClass;
    }

    /**
     * Add a where clause to the query
     */
    public function where($column, $operator = '=', $value = null)
    {
        // If only 2 parameters, assume operator is '='
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }
        
        $this->query->where($column, $operator, $value);
        return $this;
    }

    /**
     * Add a raw where clause to the query
     */
    public function whereRaw($expr)
    {
        $this->query->whereRaw($expr);
        return $this;
    }

    /**
     * Execute the query and return model instances
     */
    public function get()
    {
        $rows = $this->query->get();
        $results = [];
        
        foreach ($rows as $row) {
            $model = new $this->modelClass();
            $model->data = $row;
            $results[] = $model;
        }
        
        return $results;
    }

    /**
     * Count the number of records
     */
    public function count()
    {
        return $this->query->count();
    }

    /**
     * Get the average of a column
     */
    public function avg($column)
    {
        return $this->query->avg($column);
    }

    /**
     * Get the maximum value of a column
     */
    public function max($column)
    {
        return $this->query->max($column);
    }

    /**
     * Order the results by a column
     */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->query->orderBy($column, $direction);
        return $this;
    }

    /**
     * Get the first record
     */
    public function first()
    {
        $row = $this->query->first();
        if (!$row) {
            return null;
        }
        
        $model = new $this->modelClass();
        $model->data = $row;
        return $model;
    }
}
