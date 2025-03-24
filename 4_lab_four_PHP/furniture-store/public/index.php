<?php

$filepath = __DIR__ . '/../storage/products.txt'; // Исправленный путь

if (!file_exists($filepath)) {
    echo "Файл данных не найден.";
    exit;
}

// Читаем данные из файла
$products = file($filepath, FILE_IGNORE_NEW_LINES);

// Проверяем, есть ли данные
if (!$products) {
    echo "Файл пустой или ошибка чтения.";
    exit;
}

// Преобразуем строки JSON в массив
$products = array_map('json_decode', $products);

// Получаем два последних продукта или заказа
$latestProducts = array_slice($products, -2);

// Отображаем два последних продукта
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="/product/style.css">
</head>
<body>
    <h1>Последние продукты</h1>
    <div class="products">
        <?php foreach ($latestProducts as $product): ?>
            <div class="product">
                <h2><?= htmlspecialchars($product->product_name) ?></h2>
                <p>Категория: <?= htmlspecialchars($product->category) ?></p>
                <p>Материалы: <?= htmlspecialchars($product->materials) ?></p>
                <p>Описание: <?= htmlspecialchars($product->description) ?></p>
                <p>Тэги: <?= implode(', ', $product->tags) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
