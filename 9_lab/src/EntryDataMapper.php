<?php

namespace Datamapper;
use PDO;
Class EntryDataMapper {

    private $conn;

    function __construct() {
        $this->conn = new PDO('mysql:host=localhost;dbname=datamapper', 'dm', 'dm');
    }

    public function getAll()
    {
        $query = 'SELECT * FROM names';
        $tmp = $this->conn->prepare($query);
        $tmp->execute();
        $data = $tmp->fetchAll();
        $objects = array();
        foreach ($data as $row){
            $objects[] = new Entry($row['id'], $row['name'], $row['surname']);
        }
        return $objects;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM names WHERE id = :id';
        $tmp = $this->conn->prepare($query);
        $tmp->execute(['id' => $id]);
        $data = $tmp->fetchAll();
        $objects = array();
        foreach ($data as $row) {
            $objects[] = new Entry($row['id'], $row['name'], $row['surname']);
        }
        return $objects;
    }

    public function findBySurname($surname)
    {
        $query = 'SELECT * FROM names WHERE surname = :surname';
        $tmp = $this->conn->prepare($query);
        $tmp->execute(['surname' => $surname]);
        $data = $tmp->fetchAll();
        $objects = array();
        foreach ($data as $row){
            $objects[] = new Entry($row['id'], $row['name'], $row['surname']);
        }
        return $objects;
    }

    public function save($id, $name, $surname)
    {
        $query = 'INSERT INTO names(id, name, surname) VALUES(:id, :name, :surname)';
        $tmp = $this->conn->prepare($query);
        $tmp->execute(['id' => $id, 'name' => $name, 'surname' => $surname]);
    }

    public function delete($id)
    {
        $query = 'DELETE FROM names WHERE id = :id';
        $tmp = $this->conn->prepare($query);
        $tmp->execute(['id' => $id]);
    }
}