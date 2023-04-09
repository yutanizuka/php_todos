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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  Token::validate();
  $action = filter_input(INPUT_GET, 'action');

  switch ($action) {
    case 'add':
      $this->add();
      break;
    case 'toggle':
      $this->toggle();
      break;
    case 'delete':
      $this->delete();
      break;
    default:
      exit;
  }

  header('Location: ' . SITE_URL);
  exit;
}

  }
  
  public function getAll()
{
  $stmt = $this->$pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $todos = $stmt->fetchAll();
  return $todos;
}


}