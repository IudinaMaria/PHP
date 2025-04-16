<?php

/**
 * Получает и форматирует сообщение об ошибке для указанного ключа.
 *
 * @param array $errors Ассоциативный массив сообщений об ошибках.
 * @param string $key Ключ, для которого нужно получить сообщение об ошибке.
 * 
 * @return string Отформатированное сообщение об ошибке, если ключ существует, иначе пустая строка.
 */
function getError($errors, $key)
{
    if (isset($errors[$key])) {
        // Если ошибка найдена, возвращаем её с HTML-форматированием
        return '<p class="text-red-500">* ' . $errors[$key] . '</p>';
    }

    return '';
}


/**
 * Очищает строку, удаляя лишние пробелы, теги HTML и преобразуя специальные символы в HTML-сущности.
 *
 * @param string $data Входная строка, которая требуется очистить.
 * @return string Очищенная строка.
 */
function sanitize(string $data)
{
    return htmlentities(strip_tags(trim($data)));
}
