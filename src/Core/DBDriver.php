<?php

namespace Phpblog\Core;

class DBDriver
{
    const FETCH_ALL = 'all';
    const FETCH_ONE = 'one';

    private $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function checkErr($query)
    {
        $info = $query->errorInfo();

        if($info[0] != \PDO::ERR_NONE){
            exit($info[2]);
        }
    }

    private function query($sql, $params = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $this->checkErr($query);
        
        return $query;
    }

    public function select($sql, $params = [], $fetch)
    {
        
        $query = $this->query($sql, $params);
        if($fetch == self::FETCH_ALL) {
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        elseif ($fetch == self::FETCH_ONE) {
            return $query->fetch(\PDO::FETCH_ASSOC);
        }
        else {
            return 'error';
        }
    }

    public function insert($table, array $params)
    {
        $colums = sprintf('(%s)', implode(', ', array_keys($params)));
        $values = sprintf('(:%s)', implode(', :', array_keys($params)));
        $sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $colums, $values);
        $this->query($sql, $params);
        return $this->pdo->lastInsertId();
    }

    public function update($table, array $params, $where)
    {
        $arr = [];
        foreach ($params as $key => $value) {
            $arr[] = $key . ' = :' . $key;  
        }
        $where = quotemeta($where);
        $value = implode(', ' , $arr);
        $sql = sprintf('UPDATE %s SET %s WHERE %s', $table, $value, $where);
        return $this->query($sql, $params);
    }

    public function delete($table, $where)
    {
        $where = quotemeta($where);
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, $where);
        return $this->query($sql);
    }
}