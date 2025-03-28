<?php
declare(strict_types=1);

// Массив транзакций с различными данными
$transactions = [
    // Первая транзакция
    [
        "id" => 1, // Уникальный идентификатор транзакции
        "date" => new DateTime("2024-08-12"), // Дата транзакции (объект DateTime)
        "amount" => 40000.00, // Сумма транзакции
        "description" => "Payment for MacBook", // Описание транзакции
        "merchant" => "iSpace", // Продавец
    ],
    // Вторая транзакция
    [
        "id" => 2, // Уникальный идентификатор транзакции
        "date" => new DateTime("2025-03-07"), // Дата транзакции
        "amount" => 5500.99, // Сумма транзакции
        "description" => "Payment for Apple Watch", // Описание транзакции
        "merchant" => "iSpace", // Продавец
    ],
    // Третья транзакция
    [
        "id" => 3, // Уникальный идентификатор транзакции
        "date" => new DateTime("2025-03-01"), // Дата транзакции
        "amount" => 567.88, // Сумма транзакции
        "description" => "Payment for Petrol", // Описание транзакции
        "merchant" => "Lukoil", // Продавец
    ],
];
