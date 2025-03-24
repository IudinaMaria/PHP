<?php
require_once '../helpers.php';

// Начинаем сессию для сохранения данных ошибок и формы
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $data = [
        'product_name' => trim($_POST['product_name'] ?? ''),
        'category' => trim($_POST['category'] ?? ''),
        'materials' => trim($_POST['materials'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'tags' => $_POST['tags'] ?? [],
        'steps' => $_POST['steps'] ?? []
    ];

    // Фильтрация и валидация данных
    $errors = validateProductData($data);

    if (!empty($errors)) {
        // Если есть ошибки, перенаправляем обратно с сообщением
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $data;
        header("Location: /product/create.php");
        exit();
    }

    // Сохранение данных
    saveProduct($data);

    // Перенаправление на главную страницу
    header("Location: /");
    exit();
}
