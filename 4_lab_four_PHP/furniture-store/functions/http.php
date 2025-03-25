<?php

/**
 * Перечисление с кодами статусов HTTP.
 * Используется для определения стандартных HTTP-статусов, которые возвращаются в ответах сервера.
 */
enum HTTP_STATUS_CODES: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case MOVED_PERMANENTLY = 301;
    case FOUND = 302;
    case SEE_OTHER = 303;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case INTERNAL_SERVER_ERROR = 500;
}

/**
 * Массив, который сопоставляет коды статусов HTTP с их текстовыми значениями.
 * Используется для формирования полного ответа при отправке заголовка HTTP.
 */
$httpStatusMessages = [
    HTTP_STATUS_CODES::OK->value => "OK",
    HTTP_STATUS_CODES::CREATED->value => "Created",
    HTTP_STATUS_CODES::NO_CONTENT->value => "No Content",
    HTTP_STATUS_CODES::MOVED_PERMANENTLY->value => "Moved Permanently",
    HTTP_STATUS_CODES::FOUND->value => "Found",
    HTTP_STATUS_CODES::SEE_OTHER->value => "See Other",
    HTTP_STATUS_CODES::BAD_REQUEST->value => "Bad Request",
    HTTP_STATUS_CODES::UNAUTHORIZED->value => "Unauthorized",
    HTTP_STATUS_CODES::FORBIDDEN->value => "Forbidden",
    HTTP_STATUS_CODES::NOT_FOUND->value => "Not Found",
    HTTP_STATUS_CODES::METHOD_NOT_ALLOWED->value => "Method Not Allowed",
    HTTP_STATUS_CODES::INTERNAL_SERVER_ERROR->value => "Internal Server Error",
];

/**
 * Отправляет HTTP-ответ с указанным кодом ошибки.
 *
 * Эта функция устанавливает HTTP-заголовок с заданным кодом ошибки и соответствующим текстом
 * из глобального массива $httpStatusMessages. После этого выполнение скрипта завершается.
 *
 * @param HTTP_STATUS_CODES $statusCode Код статуса HTTP для отправки.
 *
 * @global array $httpStatusMessages Ассоциативный массив, который сопоставляет коды статусов с их текстовыми значениями.
 *
 * @return void
 */
function sendHttpStatus(HTTP_STATUS_CODES $statusCode)
{
    global $httpStatusMessages;

    // Устанавливаем заголовок HTTP-ответа с кодом и текстом ошибки
    header($_SERVER["SERVER_PROTOCOL"] . " $statusCode->value {$httpStatusMessages[$statusCode->value]}");

    return;
}

/**
 * Перенаправляет пользователя на указанную страницу.
 *
 * @param string $location URL, на который нужно перенаправить пользователя.
 * @param HTTP_STATUS_CODES $statusCode (необязательный) Код статуса HTTP, который будет отправлен вместе с редиректом. По умолчанию - HTTP_STATUS_CODES::OK.
 *
 * @return void
 */
function route(string $location, HTTP_STATUS_CODES $statusCode = HTTP_STATUS_CODES::OK)
{
    // Отправляем HTTP статус
    sendHttpStatus($statusCode);

    // Перенаправляем на указанную страницу
    header("Location: $location");

    return;
}
