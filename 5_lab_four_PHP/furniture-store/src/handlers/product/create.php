<?php

session_start();

/**
 * 
 * @return PDO Подключение к базе данных.
 */
$pdo = getPDO();

$errors = [];

$title = trim($_POST['title'] ?? '');
$category = (int)($_POST['category'] ?? 0);
$description = trim($_POST['description'] ?? '');
$extended = trim($_POST['extended_description'] ?? '');
$price = $_POST['price'] ?? null;
$image = trim($_POST['image'] ?? '');
$tags = $_POST['tags'] ?? '';
$steps = $_POST['steps'] ?? '';

if ($title === '') {
    $errors['title'] = 'Название обязательно';
}
if ($category <= 0) {
    $errors['category'] = 'Выберите категорию';
}
if ($description === '') {
    $errors['description'] = 'Описание обязательно';
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $_POST;
    header('Location: /?page=product-create');
    exit;
}

/**
 * 
 * @param string $tags Список тегов, разделенных запятыми.
 * @param string $steps Список шагов, разделенных точкой с запятой.
 * @return array Возвращает массив с JSON-строками для тегов и шагов.
 */
$tagsJson = json_encode(array_map('trim', explode(',', $tags)));
$stepsJson = json_encode(array_map('trim', explode(';', $steps)));

/**
 * 
 * @param string $title Название продукта.
 * @param int $category ID категории продукта.
 * @param string $description Краткое описание продукта.
 * @param string $extended Расширенное описание продукта.
 * @param float|null $price Цена продукта.
 * @param string $image URL изображения продукта.
 * @param string $tagsJson JSON-строка с тегами.
 * @param string $stepsJson JSON-строка с шагами.
 * @return void
 */
$stmt = $pdo->prepare("
    INSERT INTO furniture_products (title, category, description, extended_description, price, image, tags, steps)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $title, $category, $description, $extended, $price, $image, $tagsJson, $stepsJson
]);

header('Location: /public/?page=index');
exit;