<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить рецепт</title>
</head>
<body>
    <h1>Добавить рецепт</h1>
    <form action="../../src/handlers/submitRecipe.php" method="POST">
        <label for="title">Название рецепта:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="category">Категория:</label>
        <select id="category" name="category" required>
            <option value="Основные блюда">Основные блюда</option>
            <option value="Десерты">Десерты</option>
            <option value="Закуски">Закуски</option>
        </select><br><br>

        <label for="ingredients">Ингредиенты:</label><br>
        <textarea id="ingredients" name="ingredients" required></textarea><br><br>

        <label for="description">Описание рецепта:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="tags">Тэги:</label>
        <select id="tags" name="tags[]" multiple>
            <option value="vegetarian">Вегетарианский</option>
            <option value="gluten-free">Без глютена</option>
            <option value="spicy">Острый</option>
        </select><br><br>

        <label for="steps">Шаги приготовления:</label><br>
        <textarea id="steps" name="steps" required></textarea><br><br>

        <button type="submit">Отправить</button>
    </form>
</body>
</html>
