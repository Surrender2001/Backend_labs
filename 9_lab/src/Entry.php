<?php

namespace Datamapper;

Class Entry {
  public $id;
  public $name;
  public $surname;

  public function __construct($id, $name, $surname)
  {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
  }
}
