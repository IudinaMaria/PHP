<?php
// src/db.php

/**
 * @return PDO Экземпляр PDO для работы с базой данных.
 * @throws PDOException Если не удается установить соединение с базой данных.
 */
function getPDO(): PDO
{
    static $pdo;

    if ($pdo === null) {
        $config = require __DIR__ . '/../config/db.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    return $pdo;
}