<?php

/**
 * Подключаем функции для работы с HTTP запросами
 */
require_once './functions/http.php';

/**
 * Путь к файлу с данными о товарах
 * @var string $productPath Путь к JSON файлу с данными о товарах
 */
$productPath = __DIR__ . "/data/furniture_products.json";

/**
 * Массив для хранения ошибок формы
 * @var array $errors Массив ошибок валидации
 */
$errors = [];

/**
 * Обработка POST-запроса на создание нового товара
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    // Получаем и очищаем данные из формы
    $data = [
        'name' => sanitize($_POST['name'] ?? ""),
        'description' => sanitize($_POST['description'] ?? ""),
        'categories' => $_POST['categories'] ?? "",
        'price' => $_POST['price'] ?? ""
    ];

    // Валидация данных
    if (empty($data['name'])) {
        $errors['name'] = 'Product name is required';  // Ошибка: пустое название товара
    }

    if (empty($data['description'])) {
        $errors['description'] = 'Product description is required';  // Ошибка: пустое описание товара
    }

    if (empty($data['categories'])) {
        $errors['categories'] = 'Product category is required';  // Ошибка: не выбрана категория товара
    }

    if (empty($data['price'])) {
        $errors['price'] = 'Product price is required';  // Ошибка: не указана цена товара
    } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
        $errors['price'] = 'Product price must be a positive number';  // Ошибка: цена должна быть числом больше 0
    }

    if (strlen($data['name']) > 255) {
        $errors['name'] = 'Product name is too long';  // Ошибка: слишком длинное название товара
    }

    // Если ошибок нет, добавляем новый товар
    if (count($errors) === 0) {
        // Загружаем существующие товары
        $products = file_exists($productPath) ? json_decode(file_get_contents($productPath), true) : [];

        // Добавляем новый товар в массив
        $products[] = [
            'name' => $data['name'],
            'description' => $data['description'],
            'categories' => $data['categories'],
            'price' => number_format((float)$data['price'], 2, '.', ''),  // Форматируем цену
        ];

        // Сохраняем обновленные данные в файл
        file_put_contents($productPath, json_encode($products, JSON_PRETTY_PRINT));

        // Редирект на главную страницу
        route('/');

        return;
    }

    // Если есть ошибки, отправляем статус 400
    sendHttpStatus(HTTP_STATUS_CODES::BAD_REQUEST);
}
