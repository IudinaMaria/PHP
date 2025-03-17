<?php  
// Указываем папку с изображениями
$dir = 'images/';

// Получаем список всех файлов в папке
$files = scandir($dir);

// Проверка на ошибки при открытии папки
if ($files === false) {
    echo "Ошибка: не удалось открыть папку с изображениями!";
    $files = [];  // Инициализируем пустой массив в случае ошибки
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Б, initial-scale=1.0">
    <title>Porsche</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Porsche Gallery</h1>
        <p>Company | Products | Motorsports</p>
    </header>
    <main>
        <div class="gallery">
            <?php
            // Проходим по каждому файлу в директории
            for ($i = 0; $i < count($files); $i++) {
                // Пропускаем текущую и родительскую директории, а также проверяем, что файл - изображение
                if ($files[$i] !== "." && $files[$i] !== ".." && preg_match('/\.(jpg|jpeg|png|gif)$/i', $files[$i])) {
                    // Формируем полный путь к файлу
                    $path = $dir . $files[$i];
            ?>
            <div class="image">
                <!-- Выводим изображение на страницу -->
                <img src="<?php echo $path ?>" alt="Image">
            </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
    <footer>
        <!-- Выводим текущий год -->
        <p>© <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
