<?php

// Указываем путь к файлу с данными о товарах
$productsPath = __DIR__ . "/furniture_products.json";

// Проверяем, существует ли файл с данными о товарах
// Если файл существует, то загружаем его содержимое в массив, используя json_decode
// Если файл не существует, инициализируем переменную как пустой массив
$products = file_exists($productsPath) ?
    json_decode(file_get_contents($productsPath), true) :
    [];
