<?php

/**
 * Валидация данных формы
 */
function validateProductData(array $data): array {
    $errors = [];

    if (empty($data['product_name'])) {
        $errors['product_name'] = 'Введите название продукта';
    }

    if (empty($data['category'])) {
        $errors['category'] = 'Выберите категорию';
    }

    if (empty($data['materials'])) {
        $errors['materials'] = 'Введите материалы';
    }

    if (empty($data['description'])) {
        $errors['description'] = 'Введите описание';
    }

    if (empty($data['steps']) || !is_array($data['steps']) || count(array_filter($data['steps'])) === 0) {
        $errors['steps'] = 'Добавьте хотя бы один шаг';
    }

    return $errors;
}

/**
 * Сохранение данных в файл JSON
 */
function saveProduct(array $data): void {
    $filePath = __DIR__ . '/../storage/products.txt';

    // Проверяем, существует ли файл, и считываем данные
    if (file_exists($filePath)) {
        $products = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $products = [];
    }

    // Добавляем новую запись в формате JSON
    $products[] = json_encode($data, JSON_UNESCAPED_UNICODE);

    // Записываем обратно в файл
    file_put_contents($filePath, implode(PHP_EOL, $products) . PHP_EOL);
}
