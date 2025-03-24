<?php
/**
 * Функция для фильтрации данных
 */
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}
