<?php

/**
 *
 * @return PDO Объект PDO для работы с базой данных.
 */
$pdo = getPDO();

/**
 * Идентификатор записи, которую нужно удалить.
 *
 * @var int $id
 */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    /**
     *
     * @var PDOStatement $stmt Подготовленный запрос для удаления записи.
     */
    $stmt = $pdo->prepare("DELETE FROM furniture_products WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: /public/?page=index');
exit;