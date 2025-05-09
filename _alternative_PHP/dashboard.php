<?php

$dataFile = "data.json";

if (!file_exists($dataFile)) {
    echo "Что-то пошло не так, файл данных не найден. :(";
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Что-то пошло не так, ошибка чтения JSON.";
    exit;
}

$results = isset($data["results"]) ? $data["results"] : [];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты теста 😏</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Таблица результатов теста 😳</h2>

<table class="table">
    <thead>
        <tr>
            <th>Господин полупокер</th>
            <th>Истинну глаголил</th>
            <th>Согласно подсчетам это</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?=htmlspecialchars($result["username"]) ?></td>
                <td><?=htmlspecialchars($result["correct"]) ?></td>
                <td><?=htmlspecialchars($result["score"]) ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="test.php" class="button">Еще одна попытка опозориться</a>

</body>
</html>
