<?php
session_start();

if ($_SESSION['admin']) {
  header("Location: /admin");
}

$admin = 'admin';
$pass = '202cb962ac59075b964b07152d234b70';

if ($_POST['submit']) {
  if ($admin == $_POST['user'] AND $pass == md5($_POST['pass'])) {
    $_SESSION['admin'] = $admin;
    header("Location: /admin");
    exit;
  }
  else
  {
    echo '<p style="text-align: center;">Неправильный логин или пароль</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход в панель управления</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="login-page">
    <?= $bodyauthorization ?>
    </body>
</html>