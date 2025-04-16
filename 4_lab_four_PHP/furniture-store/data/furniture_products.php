<?php

$productsPath = __DIR__ . "/furniture_products.json";

$products = file_exists($productsPath) ?
    json_decode(file_get_contents($productsPath), true) :
    [];
