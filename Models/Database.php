<?php

class Database {

    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getById($table, $id){
        $stm = $this->pdo->prepare('SELECT * FROM '.$table.' WHERE `id` = :id');
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row: [];
    }

    public function readAll($table){
        $stm = $this->pdo->prepare('SELECT * FROM '.$table);
        $success = $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $rows: [];
    }
    public function readLimit($table, $limit, $offset) {
        $stm = $this->pdo->prepare('SELECT * FROM '.$table.' ORDER BY id ASC LIMIT '.$limit.' OFFSET '.$offset);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row: [];
    }
    public function getCount($table) {
        $stm = $this->pdo->prepare('SELECT count(*) as items_count FROM '.$table);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row[0]: [];
    }
    public function create($table, $data) {
        $columns = array_keys($data);
        $columnSql = implode(',', $columns);
        $bindingSql = ':'.implode(',:', $columns);
        $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
        $stm = $this->pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stm->bindValue(':'.$key, $value);
        }
        $status = $stm->execute();

        return ($status) ? $this->pdo->lastInsertId() : false;
    }
    public function update($table, $id, $data) {
        if (isset($data['id']))
            unset($data['id']);
        $columns = array_keys($data);
        $columns = array_map(function($item){
            return $item.'=:'.$item;
        }, $columns);
        $bindingSql = implode(',', $columns);
        $sql = "UPDATE $table SET $bindingSql WHERE `id` = :id";
        $stm = $this->pdo->prepare($sql);
        $data['id'] = $id;
        foreach ($data as $key => $value){
            $stm->bindValue(':'.$key, $value);
        }
        $status = $stm->execute();
        return $status;
    }

    public function delete($table, $id)
    {
        $stm = $this->pdo->prepare('DELETE FROM '.$table.' WHERE id = :id');
        $stm->bindParam(':id', $id);
        $success = $stm->execute();
        return ($success);
    }
}