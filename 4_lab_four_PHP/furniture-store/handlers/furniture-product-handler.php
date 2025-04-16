<?php

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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $data = [
        'name' => sanitize($_POST['name'] ?? ""),
        'description' => sanitize($_POST['description'] ?? ""),
        'categories' => $_POST['categories'] ?? "",
        'price' => $_POST['price'] ?? ""
    ];

    if (empty($data['name'])) {
        $errors['name'] = 'Product name is required'; 
    }

    if (empty($data['description'])) {
        $errors['description'] = 'Product description is required'; 
    }

    if (empty($data['categories'])) {
        $errors['categories'] = 'Product category is required';  
    }

    if (empty($data['price'])) {
        $errors['price'] = 'Product price is required';  
    } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
        $errors['price'] = 'Product price must be a positive number';  
    }

    if (strlen($data['name']) > 255) {
        $errors['name'] = 'Product name is too long';  
    }

    
    if (count($errors) === 0) {
        
        $products = file_exists($productPath) ? json_decode(file_get_contents($productPath), true) : [];

       
        $products[] = [
            'name' => $data['name'],
            'description' => $data['description'],
            'categories' => $data['categories'],
            'price' => number_format((float)$data['price'], 2, '.', ''),  
        ];

        file_put_contents($productPath, json_encode($products, JSON_PRETTY_PRINT));

        route('/');

        return;
    }

    sendHttpStatus(HTTP_STATUS_CODES::BAD_REQUEST);
}
