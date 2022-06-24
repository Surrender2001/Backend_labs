<?php

namespace AR\Manga;

use PDO;

class Manga
{
    private $id;
    private $title;
    private $author;
    private PDO $connection;

    public function __construct()
    {
        echo '-------------';
        $this->connection = new PDO('mysql:host=localhost;dbname=mangadb', 'muser', 'qqq');
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

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

//    public function findById($id)
//    {
//        $sql = 'SELECT * from manga WHERE id=:id LIMIT 1';
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindParam('id', $id);
//        $stmt->execute();
//        return $stmt->fetchAll()[0];
//    }
//
//    public function findByAuthor($author)
//    {
//        $sql = 'SELECT * from manga WHERE author=:author';
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindParam('author', $author);
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }

    public function getAll()
    {
        $sql = 'SELECT * from manga';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save()
    {
        $id = $this->id;
        $title = $this->title;
        $author = $this->author;
        $sql = 'INSERT INTO manga(id, title, author) values(:id, :title, :author)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('title', $title);
        $stmt->bindParam('author', $author);
        $stmt->execute();
    }

//    public function delete()
//    {
//        $id = $this->id;
//        $sql = 'DELETE FROM manga WHERE id=:id';
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindParam('id', $id);
//        $stmt->execute();
//    }

}