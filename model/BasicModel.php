<?php

namespace model; 
use core\DBDriver;
use core\Validator;
use core\Exception\InvalidDataException;

abstract class BasicModel
{
    protected $dbdriver;
    public $table;

    public function __construct(DBDriver $dbdriver, $table, Validator $validator)
    {
        $this->dbdriver = $dbdriver;
        $this->table = $table;
        $this->validator = $validator;
    }

    public function getAll($orderBy = 'dt', $order = 'DESC')
    {
        $sql = sprintf('SELECT * FROM %s ORDER BY %s %s' , $this->table , $orderBy, $order);
        return $this->dbdriver->select($sql, [], 'all');
    }

    public function getOnce($id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id_news = :id', $this->table);
        return $this->dbdriver->select($sql, ['id' => $id], 'one');
    }

    public function add(array $arr)
    {
        $this->validator->execute($arr);
        if(!$this->validator->success) {
            throw new InvalidDataException($this->validator->errors);
        }
        return $this->dbdriver->insert($this->table, $arr);
    }

    public function update(array $field, $where)
    {
        $this->validator->execute($field);
        if(!$this->validator->success) {
            throw new InvalidDataException($this->validator->errors);
        }
        $this->dbdriver->update($this->table, $field, $where);
        return $id;
    }
    
    public function delete($where)
    {
        $this->dbdriver->delete($this->table, $where);
    }
}