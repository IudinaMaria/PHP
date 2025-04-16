<?php
declare(strict_types=1);

$transactions = [
    [
        "id" => 1,
        "date" => new DateTime("2024-08-12"),
        "amount" => 40000.00,
        "description" => "Payment for MacBook",
        "merchant" => "iSpace",
    ],
   
    [
        "id" => 2,
        "date" => new DateTime("2025-03-07"), 
        "amount" => 5500.99, 
        "description" => "Payment for Apple Watch",
        "merchant" => "iSpace", 
    ],
    
    [
        "id" => 3, 
        "date" => new DateTime("2025-03-01"), 
        "amount" => 567.88, 
        "description" => "Payment for Petrol", 
        "merchant" => "Lukoil",
    ],
];
