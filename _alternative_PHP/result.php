<?php
/**
 * Получение данных из параметров GET запроса.
 * 
 * @var int $correctCount Количество правильных ответов.
 * @var float $score Процент правильных ответов.
 */
$correctCount = isset($_GET["correct"]) ? (int)$_GET["correct"] : 0;
$score = isset($_GET["score"]) ? (float)$_GET["score"] : 0;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Посмотрим, как ты тут навалил кринжа</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="result-box">
    <h2>Твой кринж-результат</h2>
    <p class="result-text">
        Не все так плохо, тут есть надежда <b><?= $correctCount ?></b>
    </p>
    <p class="result-text">
        Вот на столько ты далек от 30 <b><?= $score ?>%</b>
    </p>
    <a href="test.php" class="button">Кринжануть еще разок</a>
    <a href="dashboard.php" class="button">Список тех, кто уже кринжанул</a>
    <a href="index.php" class="button">Вернуться к истокам</a>
</div>

</body>
</html>
