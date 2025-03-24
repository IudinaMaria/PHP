<?php
// Чтение всех рецептов
$recipes = file('/../../storage/recipes.txt', FILE_IGNORE_NEW_LINES);
$recipes = array_map('json_decode', $recipes);

// Пагинация
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recipesPerPage = 5;
$offset = ($page - 1) * $recipesPerPage;
$recipesPage = array_slice($recipes, $offset, $recipesPerPage);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все рецепты</title>
</head>
<body>
    <h1>Все рецепты</h1>
    <ul>
        <?php foreach ($recipesPage as $recipe): ?>
            <li>
                <h2><?php echo htmlspecialchars($recipe->title); ?></h2>
                <p>Категория: <?php echo htmlspecialchars($recipe->category); ?></p>
                <p>Описание: <?php echo htmlspecialchars($recipe->description); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Пагинация -->
    <div>
        <a href="?page=<?php echo max(1, $page - 1); ?>">Предыдущая</a>
        <a href="?page=<?php echo $page + 1; ?>">Следующая</a>
    </div>
</body>
</html>
