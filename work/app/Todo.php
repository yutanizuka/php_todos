<?php

class Todo
{
  private $pdo;
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function processPost()
  {

  }
  
  public function getAll()
{
  $stmt = $this->$pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $todos = $stmt->fetchAll();
  return $todos;
}


}