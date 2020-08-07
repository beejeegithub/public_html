<?php
session_start();

if ($_GET['do'] == 'logout') {
    unset($_SESSION['admin']);
    session_destroy();
}

if (!$_SESSION['admin']) {
    header("Location: /");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Панель управления</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    <?= $bodyadmin ?>
    </body>
</html>