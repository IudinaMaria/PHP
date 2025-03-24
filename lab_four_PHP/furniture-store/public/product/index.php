<?php
// Количество продуктов на странице
$productsPerPage = 5;

// Читаем данные из файла, если он существует
$filename = __DIR__ . '/../storage/products.txt'; // Абсолютный путь
$products = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES) : [];

// Преобразуем строки JSON в массив, фильтруем ошибки
$products = array_map('json_decode', $products);
$products = array_filter($products); // Убираем `null` значения

// Получаем номер текущей страницы
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Вычисляем общее количество страниц
$totalPages = max(1, ceil(count($products) / $productsPerPage));

// Ограничиваем `$page` допустимыми значениями
$page = min($page, $totalPages);

// Вычисляем индекс первого элемента
$startIndex = ($page - 1) * $productsPerPage;

// Получаем только нужные продукты
$currentPageProducts = array_slice($products, $startIndex, $productsPerPage);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукты</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <h1>Все продукты</h1>
    <div class="products">
        <?php foreach ($currentPageProducts as $product): ?>
            <div class="product">
                <h2><?= htmlspecialchars($product->product_name ?? 'Без названия') ?></h2>
                <p>Категория: <?= htmlspecialchars($product->category ?? 'Не указано') ?></p>
                <p>Материалы: <?= htmlspecialchars($product->materials ?? 'Не указано') ?></p>
                <p>Описание: <?= htmlspecialchars($product->description ?? 'Нет описания') ?></p>
                <p>Тэги: <?= isset($product->tags) ? implode(', ', array_map('htmlspecialchars', (array)$product->tags)) : 'Нет тегов' ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Пагинация -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="/product/index.php?page=<?= $page - 1 ?>">Предыдущая</a>
        <?php endif; ?>
        
        <span>Страница <?= $page ?> из <?= $totalPages ?></span>
        
        <?php if ($page < $totalPages): ?>
            <a href="/product/index.php?page=<?= $page + 1 ?>">Следующая</a>
        <?php endif; ?>
    </div>
</body>
</html>
