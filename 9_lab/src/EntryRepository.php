<?php

namespace Datamapper;

Class EntryRepository {
    private $entryDataMapper;
    private $entryArray;

    function __construct()
    {
        $this->entryDataMapper = new EntryDataMapper();
        $this->entryArray = $this->entryDataMapper->getAll();
    }

    public function getAll()
    {
        return $this->entryArray;
    }

    public function findById($id)
    {
        return $this->entryDataMapper->findById($id);
    }

    public function findBySurname($surname)
    {
        return $this->entryDataMapper->findBySurname($surname);
    }

    public function save($id, $name, $surname)
    {
        $this->entryDataMapper->save($id, $name, $surname);
    }

    public function delete($id)
    {
        $this->entryDataMapper->delete($id);
    }
}