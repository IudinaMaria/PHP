<?php

declare(strict_types=1);

/**
 * Главный файл приложения (точка входа).
 */

define('PROJECT_NAME', 'Furniture Store');

// Подключение конфигураций и вспомогательных файлов
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/helpers.php';

/**
 * @var string $page Название текущей страницы (по умолчанию 'index').
 */
$page = $_GET['page'] ?? 'index';

/**
 * @var string|null $action Действие, связанное с текущей страницей (например, 'create', 'edit', 'delete').
 */
$action = $_GET['action'] ?? null;

ob_start();

/**
 * 
 * @var string $templatePath Абсолютный путь к папке с шаблонами.
 */
$templatePath = __DIR__ . '/../templates/';

switch ($page) {
    case 'index':
        require $templatePath . 'index.php';
        break;

    case 'product-create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/../src/handlers/product/create.php';
        }
        require $templatePath . 'product/create.php';
        break;

    case 'product':
        require $templatePath . 'product/show.php';
        break;

    case 'product-edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/../src/handlers/product/edit.php';
        }
        require $templatePath . 'product/edit.php';
        break;

    case 'product-delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/../src/handlers/product/delete.php';
        } else {
            http_response_code(405); // Метод не разрешен
            echo "<h1 class='text-white text-center'>Invalid request</h1>";
        }
        break;

    default:
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        break;
}

/**
 * Содержимое страницы, сгенерированное в процессе выполнения маршрутов.
 * 
 * @var string $content HTML-контент страницы.
 */
$content = ob_get_clean();

require $templatePath . 'layout.php';