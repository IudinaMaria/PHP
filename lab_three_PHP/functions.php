<?php

declare(strict_types=1);

/**
 * Вычисляет общую сумму транзакций.
 * 
 * Эта функция суммирует все значения транзакций и возвращает общую сумму.
 * 
 * @param array $transactions Массив транзакций.
 * @return float Возвращает общую сумму транзакций.
 */
function calculateTotalAmount(array $transactions): float {
    $total = 0;
    foreach ($transactions as $transaction) {
        $total += $transaction["amount"];
    }
    return $total;
}

/**
 * Ищет транзакции, содержащие заданную подстроку в описании.
 * 
 * Эта функция ищет транзакции, у которых описание содержит указанную подстроку (без учета регистра).
 * 
 * @param array $transactions Массив транзакций.
 * @param string $descriptionPart Подстрока для поиска в описании транзакции.
 * @return array Массив транзакций, описание которых содержит подстроку.
 */
function findTransactionByDescription(array $transactions, string $descriptionPart): array {
    $foundTransactions = [];

    foreach ($transactions as $transaction) {
        if (stripos($transaction["description"], $descriptionPart) !== false) {
            $foundTransactions[] = $transaction;
        }
    }

    return $foundTransactions;
}

/**
 * Ищет транзакцию по её идентификатору.
 * 
 * Эта функция ищет транзакцию по уникальному идентификатору.
 * 
 * @param array $transactions Массив транзакций.
 * @param int $id Идентификатор транзакции.
 * @return array|null Возвращает транзакцию в виде массива, если найдена, иначе возвращает null.
 */
function findTransactionById(array $transactions, int $id): ?array {
    foreach ($transactions as $transaction) {
        if ($transaction["id"] === $id) {
            return $transaction;
        }
    }
    return null;
}

/**
 * Вычисляет количество дней, прошедших с момента указанной даты транзакции.
 * 
 * Эта функция вычисляет разницу в днях между текущей датой и датой транзакции.
 * 
 * @param DateTime $date Дата транзакции.
 * @return int Количество дней, прошедших с момента транзакции.
 */
function daysSinceTransaction(DateTime $date): int {
    $currentDate = new DateTime();
    return $date->diff($currentDate)->days;
}

/**
 * Добавляет новую транзакцию в глобальный массив транзакций.
 * 
 * Эта функция добавляет новую транзакцию в массив `$transactions`, обновляя его.
 * 
 * @param int $id Идентификатор транзакции.
 * @param string $date Дата транзакции.
 * @param float $amount Сумма транзакции.
 * @param string $description Описание транзакции.
 * @param string $merchant Продавец или компания, с которой была совершена транзакция.
 * @return void Функция не возвращает значения.
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;

    $transactions[] = [
        "id" => $id,
        "date" => new DateTime($date),
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}

/**
 * Сортирует массив транзакций по дате в порядке возрастания.
 * 
 * Эта функция сортирует массив транзакций по дате в порядке возрастания.
 * 
 * @param array &$transactions Массив транзакций, который будет отсортирован.
 * @return void Функция не возвращает значения, изменяет массив по ссылке.
 */
function sortTransactionsByDate(array &$transactions) {
    usort($transactions, function ($a, $b) {
        return $a["date"] <=> $b["date"];
    });
}

/**
 * Сортирует массив транзакций по сумме в порядке убывания.
 * 
 * Эта функция сортирует массив транзакций по сумме в порядке убывания.
 * 
 * @param array &$transactions Массив транзакций, который будет отсортирован.
 * @return void Функция не возвращает значения, изменяет массив по ссылке.
 */
function sortTransactionsByAmount(array &$transactions): void {
    usort($transactions, function ($a, $b) {
        return $b["amount"] <=> $a["amount"];
    });
}
