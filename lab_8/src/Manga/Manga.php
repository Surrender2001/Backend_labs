<?php

namespace AR\Manga;

use mysql_xdevapi\Exception;
use PDO;
use PDOException;

class Manga
{
    private $id;
    private $title;
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=workers', 'anime', 'ismylife');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }



  public function findById($id)
    {
        $sql = 'SELECT * from anime WHERE id=:id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchAll()[0];
    }

    public function findByName($name)
    {
        $sql = 'SELECT * from anime WHERE name=:name';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['name',$name]);
        return $stmt->fetchAll();
    }

    public function getAll():array
    {

            $sql = 'select * from anime';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();


//        $dbh = new PDO('mysql:host=localhost;dbname=workers', 'anime', 'ismylife');
//        $rows = $dbh->query('SELECT * from anime');
//        return $rows;

    }

    //ActiveRecord
    public function save()
    {
        $id = $this->id;
        $title = $this->title;
        $sql = 'INSERT INTO anime(id, name) values(:id, :title)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id'=>$id,'title'=>$title,]);
    }

    public function delete()
    {
        $id = $this->id;
        $sql = 'DELETE FROM anime WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id'=>$id]);

    }

}
