<?php

session_start();
define('DSN', 'mysql:host=db;dbname=myapp;charset=utf8mb4');
define('DB_USER','myappuser');
define('DB_PASS','myapppass');
// define('SITE_URL', 'http://localhost:8562');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

createToken();

function createToken()
{
  if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
}

function validateToken()
{
  if (
    empty($_SESSION['token']) ||
    $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
  ) {
    exit('Invalid post request');
  }
}

try {
  $pdo = new PDO(
    DSN,
    DB_USER,
    DB_PASS,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES => false,
  ]
  );
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function addTodo($pdo)
{
  $title = trim(filter_input(INPUT_POST,'title'));
  if ($title ===''){
    return;
  }

  $stmt = $pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
  $stmt->bindValue('title', $title, PDO::PARAM_STR);
  $stmt->execute();
}
function getTodos($pdo)
{
  $stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $todos = $stmt->fetchAll();
  return $todos;
}



  // $todos = getTodos($pdo);
  // var_dump($todos);

  // exit;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validateToken();
  addTodo($pdo);

  header('Location: ' . SITE_URL);
}

$todos = getTodos($pdo);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Todos</h1>
  <form action="" method="post">
    <input type="text" name= "title" placeholder="Type new todo">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <button>Add</button>
  <ul>
    <?php foreach ($todos as $todo): ?>
    <li>
    <input type="checkbox"<?= $todo->is_done ? 'checked' : '';?>>
    <span class="<?= $todo->is_done ? 'done' : ''; ?>">
    <?= h($todo->title); ?>
    
  </li>
  <?php endforeach; ?>

  
  
</ul>
  
</body>
</html>