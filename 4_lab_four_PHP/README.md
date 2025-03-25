# Лабораторная работа №4. Валидация форм

## Цель работы

Освоить основные принципы работы с HTML-формами в PHP, включая отправку данных на сервер и их обработку, включая валидацию данных.

Данная работа станет основой для дальнейшего изучения разработки веб-приложений. Дальнейшие лабораторные работы будут основываться на данной.

## Условие

Bыбрать тему проекта для лабораторной работы, которая будет развиваться на протяжении курса.

**Furniture Store**:

### Задание 1. Создание проекта

1. Создайте корневую директорию проекта.
2. Организуйте файловую структуру проекта:
   ```
    ├── furniture-store/
    ├──  assets/
    │         ├──image/                          # Фото
    │         │      └──*images*
    │         ├── js/                            # Скрипт для формы
    │         │    └── addStep.js
    │         └──styles/                         # Стили Tailwind
    │                 ├──input.css
    │                 └──output.css
    ├── components/
    │            ├──footer.php                   # футер
    │            └──header.php                   # хедер
    ├── data/
    │      ├──furniture_products.json            # хранение
    │      └──furniture_products.php             # декод
    ├── functions/                               # Шаблоны ошибок
    │           ├──http.php
    │           └──template.php
    ├── handlers/                                # Обработчики форм
    │          └──furniture-product-handler.php
    ├── index.php                                # Главная страница
    ├── product-create.php                       # Форма
    ├── product.php                              # Страница с отображением продуктов
    ├── search.php                               # Поиск/Фильтрация
    └── README.md                                # Описание проекта
   ```

### Задание 2. Создание формы добавления рецепта

1. Создайте HTML-форму.
2. Форма должна содержать следующие поля:
   - Название рецепта (`<input type="text">`);
   - Категория рецепта (`<select>`);
   - Ингредиенты (`<textarea>`);
   - Описание рецепта (`<textarea>`);
   - Тэги (выпадающий список с возможностью выбора нескольких значений, `<select multiple>`).

```php
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $_POST['name'] ?? ''; ?>">
            <?php echo getError($errors, 'name'); ?>

            <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Product Category</label>
            <select id="categories" name="categories" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="furniture">Furniture</option>
                <option value="decor">Decor</option>
                <option value="appliances">Appliances</option>
                <option value="accessories">Accessories</option>
            </select>
            <?php echo getError($errors, 'categories'); ?>

            <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Tags</label>
            <select id="tags" name="tags[]" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="modern">Modern</option>
                <option value="classic">Classic</option>
                <option value="minimalist">Minimalist</option>
                <option value="luxury">Luxury</option>
            </select>
            <?php echo getError($errors, 'tags'); ?>

            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Product Description</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $_POST['description'] ?? ''; ?></textarea>
            <?php echo getError($errors, 'description'); ?>

            <label for="extended_description" class="block text-gray-700 text-sm font-bold mb-2">Extended Description</label>
            <textarea id="extended_description" name="extended_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $_POST['extended_description'] ?? ''; ?></textarea>
            <?php echo getError($errors, 'extended_description'); ?>

            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
            <input type="number" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $_POST['price'] ?? ''; ?>" step="0.01">
            <?php echo getError($errors, 'price'); ?>

```

3. Добавьте поле для **шагов приготовления рецепта**.
   **Расширенный вариант (на более высокую оценку)**: динамическое добавление шагов с помощью JavaScript (кнопка "Добавить шаг"), где каждый шаг — отдельное поле ввода.

```php
    <!-- Динамическое добавление шагов -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Steps</label>
            <div id="steps-container">
                <div class="step flex gap-2 mb-2">
                    <input type="text" name="steps[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter step">
                    <button type="button" class="py-1 px-4 bg-red-500 text-white rounded-md hover:bg-red-700 transition">✖</button>
                </div>
            </div>
            <button type="button" id="add-step" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">+ Add Step</button>
        </div>
```

4. Добавьте кнопку **"Отправить"** для отправки формы.

```php
    <!-- Кнопка отправки -->
        <div class="mb-4">
            <button type="submit" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">Create Product</button>
        </div>
```

### Задание 3. Обработка формы

1. Создайте в директории `handlers` файл, который будет обрабатывать данные формы.
2. **В обработчике реализуйте**:
   - Фильрацию данных;
   - Валидацию данных;
   - Сохранение данных в файл в формате JSON.
3. Чтобы избежать дублирования кода и улучшить его читаемость, рекомендуется вынести повторяющиеся операции в отдельные вспомогательные функции, разместив их в файле `src/helpers.php`.
4. После успешного сохранения данных выполните перенаправление пользователя на главную страницу.
5. Если валидация не пройдена, отобразите соответствующие ошибки на странице добавления рецепта под соответствующими полями.

Для сохранения данных в файл можно использовать разные подходы. Один из вариантов — сохранять данные в текстовый файл, где каждая строка представляет собой отдельный JSON-объект:

```php
<?php

/**
 * Подключаем функции для работы с HTTP запросами
 */
require_once './functions/http.php';

/**
 * Путь к файлу с данными о товарах
 * @var string $productPath Путь к JSON файлу с данными о товарах
 */
$productPath = __DIR__ . "/data/furniture_products.json";

/**
 * Массив для хранения ошибок формы
 * @var array $errors Массив ошибок валидации
 */
$errors = [];

/**
 * Обработка POST-запроса на создание нового товара
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Получаем и очищаем данные из формы
    $data = [
        'name' => sanitize($_POST['name'] ?? ""),
        'description' => sanitize($_POST['description'] ?? ""),
        'categories' => $_POST['categories'] ?? "",
        'price' => $_POST['price'] ?? ""
    ];

    // Валидация данных
    if (empty($data['name'])) {
        $errors['name'] = 'Product name is required';  // Ошибка: пустое название товара
    }

    if (empty($data['description'])) {
        $errors['description'] = 'Product description is required';  // Ошибка: пустое описание товара
    }

    if (empty($data['categories'])) {
        $errors['categories'] = 'Product category is required';  // Ошибка: не выбрана категория товара
    }

    if (empty($data['price'])) {
        $errors['price'] = 'Product price is required';  // Ошибка: не указана цена товара
    } elseif (!is_numeric($data['price']) || $data['price'] <= 0) {
        $errors['price'] = 'Product price must be a positive number';  // Ошибка: цена должна быть числом больше 0
    }

    if (strlen($data['name']) > 255) {
        $errors['name'] = 'Product name is too long';  // Ошибка: слишком длинное название товара
    }

    // Если ошибок нет, добавляем новый товар
    if (count($errors) === 0) {
        // Загружаем существующие товары
        $products = file_exists($productPath) ? json_decode(file_get_contents($productPath), true) : [];

        // Добавляем новый товар в массив
        $products[] = [
            'name' => $data['name'],
            'description' => $data['description'],
            'categories' => $data['categories'],
            'price' => number_format((float)$data['price'], 2, '.', ''),  // Форматируем цену
        ];

        // Сохраняем обновленные данные в файл
        file_put_contents($productPath, json_encode($products, JSON_PRETTY_PRINT));

        // Редирект на главную страницу
        route('/');

        return;
    }

    // Если есть ошибки, отправляем статус 400
    sendHttpStatus(HTTP_STATUS_CODES::BAD_REQUEST);
}
```

### Задание 4. Отображение

1. В файле отобразите 2 последних рецепта:

```php
<?php

/**
 * Константа с названием проекта
 */
define('PROJECT_NAME', 'Furniture Store');

// Подключаем файл с товарами
require_once './data/furniture_products.php';

/**
 * Получение ID товара из GET-параметров и преобразование в целое число
 * @var int $id Идентификатор товара
 */
$id = intval($_GET['id']) - 1;  // Уменьшаем на 1 для соответствия индексации массива

/**
 * Получение информации о товаре по ID
 * @var array|null $product Найденный товар или null, если не найден
 */
$product = $products[$id] ?? null;

// Если товар не найден, отправляем ошибку 404
if (!$product) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

// Подключаем заголовок страницы
require_once './components/header.php';
?>

<article class="container mx-auto flex flex-col gap-8 mt-8">
    <div>
        <?php foreach ($product['categories'] as $category) : ?>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                <?php echo htmlspecialchars($category); ?>
            </span>
        <?php endforeach; ?>
    </div>
    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-100 h-100 object-cover rounded shadow-md">
    <h1 class="font-bold text-4xl font-mono"> <?php echo htmlspecialchars($product['name']); ?> </h1>
    <p class="text-lg"> <?php echo htmlspecialchars($product['description']); ?> </p>
    <p class="text-lg text-gray-800 font-bold"> <?php echo '$' . number_format($product['price'], 2); ?> </p>
    <a class="text-blue-700 transition duration-300 ease-in-out transform hover:translate-x-1 hover:text-blue-900" href="/">← Back to products</a>
</article>

<?php
// Подключаем футер
require_once './components/footer.php';
?>

```

2. В файле отобразите все из файла.

```php
<?php 

/**
 * Константа для названия проекта
 */
define('PROJECT_NAME', 'Furniture Store');

// Подключаем файл с данными о товарах
require_once './data/furniture_products.php';

/**
 * Подключаем компонент заголовка страницы
 */
require_once './components/header.php'; 

?>

<main class="container mx-auto">  <!-- Основной контейнер для контента страницы -->
    <h1 class="my-6 font-bold text-4xl font-mono text-white">Products</h1>
    
    <!-- Грид для отображения товаров -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <!-- Цикл для отображения всех товаров -->
        <?php foreach ($products as $id => $product) : ?>  
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <!-- Изображение товара -->
                <img class="w-60 h-60 object-cover rounded shadow-md" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">  
                
                <!-- Название товара -->
                <h1 class="text-xl font-medium text-white"><?php echo $product['name']; ?></h1>  
                
                <!-- Описание товара -->
                <p class="line-clamp-2 text-white"><?php echo $product['description']; ?></p>  
                
                <!-- Цена товара -->
                <p class="text-lg text-white font-bold "><?php echo '$' . number_format($product['price'], 2); ?></p>  
                
                <!-- Ссылка на подробную информацию о товаре -->
                <a class="text-white" href="/product.php?id=<?php echo $id + 1; ?>">Read more ...</a>  
            </div>
        <?php endforeach; ?>
        
        <!-- Блок для кнопки добавления нового товара -->
        <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
            <a href="/product-create.php">  <!-- Ссылка на страницу создания нового товара -->
                <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer text-white">
                    +
                </button>
            </a>
        </div>
    </div>
    
</main>

<?php 
/**
 * Подключаем компонент футера страницы
 */
require_once './components/footer.php'; 
?>  
```

### Дополнительное задание

1. Реализуйте пагинацию (постраничный вывод) списка рецептов.
2. На странице отображайте по 5 рецептов на страницу.
3. Для этого используйте GET-параметр page, например:
   - `/***/index.php?page=2` — отобразить 2 страницу рецептов.
   - `/***/index.php?page=3` — отобразить 3 страницу рецептов.
   - Если страница не указана, отобразите первую страницу.

```php
   /**
 * Получение ID товара из GET-параметров и преобразование в целое число
 * @var int $id Идентификатор товара
 */
$id = intval($_GET['id']) - 1;  // Уменьшаем на 1 для соответствия индексации массива
```

## Документация кода

Код должен быть корректно задокументирован, используя стандарт `PHPDoc`. Каждая функция и метод должны быть описаны с указанием их входных параметров, выходных данных и описанием функционала. Комментарии должны быть понятными, четкими и информативными, чтобы обеспечить понимание работы кода другим разработчикам.

## Контрольные вопросы

1. Какие методы HTTP применяются для отправки данных формы?
**GET:** Этот метод отправляет данные формы в строке запроса URL. Данные видны в адресной строке браузера, что может быть проблемой с точки зрения безопасности. GET обычно используется для запросов, где данные не чувствительны, например, для поиска.
Подходит для получения данных, например, при поиске.
**POST:** Этот метод отправляет данные формы в теле запроса, и они не отображаются в адресной строке браузера. POST является более безопасным, так как данные не видны и не ограничены длиной, как в GET. Используется для отправки данных, связанных с созданием, обновлением или удалением данных.
Подходит для отправки конфиденциальных данных, например, при регистрации, отправке сообщений и других действиях, которые изменяют состояние на сервере.
2. Что такое валидация данных, и чем она отличается от фильтрации?
**Валидация данных** — это процесс проверки того, соответствуют ли данные ожидаемым правилам или форматам, прежде чем они будут обработаны. Валидация отвечает на вопросы типа: "Являются ли данные правильными?", "Соответствуют ли они нужному формату (например, e-mail, дата)?"
**Фильтрация данных** — это процесс обработки данных с целью их очищения или приведения в нужный формат. Фильтрация используется для удаления нежелательных символов или приведения данных к стандартному виду.
**Отличия:**
Валидация проверяет корректность данных.
Фильтрация изменяет или очищает данные для безопасной обработки или использования.
3. Какие функции PHP используются для фильтрации данных?
В PHP существует несколько встроенных функций для фильтрации данных:
**filter_var():** Эта функция используется для фильтрации одиночных данных с помощью фильтров. Она может быть использована для различных типов фильтрации, таких как удаление нежелательных символов, проверка корректности URL, e-mail, и других.
**filter_input():** Эта функция аналогична filter_var(), но используется для фильтрации данных, поступающих из внешних источников, например, из массива $_GET, $_POST, $_REQUEST.
**filter_var_array():** Эта функция используется для фильтрации массива данных с применением различных фильтров к каждому элементу массива.
Фильтрация данных с помощью этих функций помогает защитить систему от нежелательных данных и предотвратить уязвимости, такие как XSS (межсайтовые скрипты).

## Установка

1. Склонируйте репозиторий
2. Установите зависимости для tailwindcss
   ```bash
   npm install
   ```
4. Запустите сервер
   ```bash
   php -S localhost:8000
   ```
5. Для отслеживания изменений в CSS запустите
   ```bash
   npm run watch
   ```