<?php
// Чтение данных из файла
$recipes = explode("\n", file_get_contents('/../../storage/recipes.txt'));

// Преобразуем строки JSON в массив
$recipes = array_map('json_decode', $recipes);

// Получаем два последних рецепта
$latestRecipes = array_slice($recipes, -2);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
</head>
<body>
    <h1>Последние рецепты</h1>
    <ul>
        <?php foreach ($latestRecipes as $recipe): ?>
            <li>
                <h2><?php echo htmlspecialchars($recipe->title); ?></h2>
                <p>Категория: <?php echo htmlspecialchars($recipe->category); ?></p>
                <p>Описание: <?php echo htmlspecialchars($recipe->description); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="recipe/index.php">Посмотреть все рецепты</a>
</body>
</html>
