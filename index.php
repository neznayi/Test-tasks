<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comm inlaine</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    
<h1>Поиск записей по тексту комментария</h1>
<form method="GET" action="">
    <input 
        type="text" 
        name="query" 
        class = "place" placeholder="Введите текст комментария" 
        required 
        minlength="3" 
        value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>"
    >
    <button type="submit">Найти</button>
    <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>">Сбросить</a>
</form>

<?php
include 'php.php';
?>
</body>
</html>