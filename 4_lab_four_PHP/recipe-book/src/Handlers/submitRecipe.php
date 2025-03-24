<?php
include_once('../helpers.php');

// Получаем данные из формы
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
$ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$tags = $_POST['tags'];
$steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_STRING);

// Валидация данных
$errors = [];

if (empty($title)) {
    $errors[] = 'Название рецепта не может быть пустым.';
}
if (empty($category)) {
    $errors[] = 'Категория не выбрана.';
}
if (empty($ingredients)) {
    $errors[] = 'Ингредиенты не могут быть пустыми.';
}
if (empty($description)) {
    $errors[] = 'Описание не может быть пустым.';
}
if (empty($steps)) {
    $errors[] = 'Шаги приготовления не могут быть пустыми.';
}

if (empty($errors)) {
    // Если нет ошибок, сохраняем данные
    $recipeData = [
        'title' => $title,
        'category' => $category,
        'ingredients' => $ingredients,
        'description' => $description,
        'tags' => $tags,
        'steps' => $steps
    ];

    // Сохраняем в файл
    $jsonData = json_encode($recipeData) . PHP_EOL;
    file_put_contents('../../storage/recipes.txt', $jsonData, FILE_APPEND);

    // Перенаправление на главную
    header('Location: ../../public/index.php');
    exit();
} else {
    // Если есть ошибки, отображаем их
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}
