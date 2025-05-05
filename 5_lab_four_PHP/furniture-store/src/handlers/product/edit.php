<?php

/**
 * @return PDO The PDO instance.
 */
$pdo = getPDO();

/**
 * @var int $id
 */
$id = (int)($_POST['id'] ?? 0);

/**
 * @var string $title
 */
$title = trim($_POST['title'] ?? '');

/**
 * @var int $category
 */
$category = (int)($_POST['category'] ?? 0);

/**
 * @var string $description
 */
$description = trim($_POST['description'] ?? '');

/**
 * @var string $extended
 */
$extended = trim($_POST['extended_description'] ?? '');

/**
 * @var float|null $price
 */
$price = $_POST['price'] ?? null;

/** 
 * @var string $image
 */
$image = trim($_POST['image'] ?? '');

/**
 * @var string $tags
 */
$tags = json_encode(array_map('trim', explode(',', $_POST['tags'] ?? '')));

/**
 * @var string $steps
 */
$steps = json_encode(array_map('trim', explode(';', $_POST['steps'] ?? '')));

$stmt = $pdo->prepare("
    UPDATE furniture_products
    SET title = ?, category = ?, description = ?, extended_description = ?, price = ?, image = ?, tags = ?, steps = ?
    WHERE id = ?
");
$stmt->execute([
    $title, $category, $description, $extended, $price, $image, $tags, $steps, $id
]);

header('Location: /public/?page=product&id=' . $id);
exit;