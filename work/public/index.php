<?php
define('DSN', 'mysql:host=db;dbname=myapp;charset=utf8mb4');
define('DB_USER','myappuser');
define('DB_PASS','myapppass');

try {
  $pdo = new PDO(
    DSN,
    DB_USER,
    DB_PASS,
    [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]
    );

  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

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
<ul>
  <li>
    <input type="checkbox">
    <sapn>Title</span>
  </li>

  <li>
    <input type="checkbox" checked>
    <sapn class="done">Title</span>
  </li>
  <li>
    <input type="checkbox">
    <sapn>Title</span>
  </li>
</ul>
  
</body>
</html>