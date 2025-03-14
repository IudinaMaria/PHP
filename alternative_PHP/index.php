<?php
/**
 * Главная страница, на которой приветствуется пользователь и предоставляется кнопка для начала прохождения теста.
 * 
 * Страница содержит кнопку для перехода на страницу с тестом, а также стилизацию с использованием внешнего CSS.
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Основа кринжа</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>

<div class="container">
    <h1 class="title">Привет, полупокер!</h1>
    
    <a href="test.php">
        <button class="start-button">Ну что, кринжанем?</button>
    </a>
</div>

</body>
</html>
