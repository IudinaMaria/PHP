<?php
session_start();
$errors = $_SESSION['errors'] ?? []; // Добавлено: Получение ошибок из сессии
$formData = $_SESSION['form_data'] ?? []; // Добавлено: Получение ранее введённых данных
unset($_SESSION['errors'], $_SESSION['form_data']); // Очищаем сессию после использования
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить продукт</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <h1>Добавить продукт</h1>

    <form action="/src/Handlers/CreateProductHandler.php" method="post">
        <label for="product_name">Название продукта:</label>
        <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($formData['product_name'] ?? '') ?>" required>
        <?php if (isset($errors['product_name'])): ?> 
            <p class="error"><?= $errors['product_name'] ?></p> 
        <?php endif; ?>

        <label for="category">Категория продукта:</label>
        <select id="category" name="category">
            <option value="">Выберите категорию</option>
            <option value="стул" <?= (isset($formData['category']) && $formData['category'] === 'стул') ? 'selected' : '' ?>>Стул</option>
            <option value="стол" <?= (isset($formData['category']) && $formData['category'] === 'стол') ? 'selected' : '' ?>>Стол</option>
            <option value="шкаф" <?= (isset($formData['category']) && $formData['category'] === 'шкаф') ? 'selected' : '' ?>>Шкаф</option>
        </select>
        <?php if (isset($errors['category'])): ?> 
            <p class="error"><?= $errors['category'] ?></p> 
        <?php endif; ?>

        <label for="materials">Материалы:</label>
        <textarea id="materials" name="materials"><?= htmlspecialchars($formData['materials'] ?? '') ?></textarea>
        <?php if (isset($errors['materials'])): ?> 
            <p class="error"><?= $errors['materials'] ?></p> 
        <?php endif; ?>

        <label for="description">Описание продукта:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        <?php if (isset($errors['description'])): ?> 
            <p class="error"><?= $errors['description'] ?></p> 
        <?php endif; ?>

        <label for="tags">Тэги:</label>
        <select id="tags" name="tags[]" multiple>
            <option value="новинка" <?= (isset($formData['tags']) && in_array('новинка', $formData['tags'])) ? 'selected' : '' ?>>Новинка</option>
            <option value="распродажа" <?= (isset($formData['tags']) && in_array('распродажа', $formData['tags'])) ? 'selected' : '' ?>>Распродажа</option>
            <option value="хит" <?= (isset($formData['tags']) && in_array('хит', $formData['tags'])) ? 'selected' : '' ?>>Хит</option>
        </select>

        <label>Шаги изготовления:</label>
        <div id="steps-container">
            <?php
            if (!empty($formData['steps'])) {
                foreach ($formData['steps'] as $step) {
                    echo '<div><input type="text" name="steps[]" value="' . htmlspecialchars($step) . '"> <button type="button" class="remove-step">Удалить</button></div>';
                }
            } else {
                echo '<div><input type="text" name="steps[]"> <button type="button" class="remove-step">Удалить</button></div>';
            }
            ?>
        </div>
        <button type="button" id="add-step">Добавить шаг</button>
        <?php if (isset($errors['steps'])): ?> 
            <p class="error"><?= $errors['steps'] ?></p> 
        <?php endif; ?>

        <button type="submit">Отправить</button>
    </form>

    <script>
        document.getElementById('add-step').addEventListener('click', function() {
            let container = document.getElementById('steps-container');
            let div = document.createElement('div');
            div.innerHTML = '<input type="text" name="steps[]"> <button type="button" class="remove-step">Удалить</button>';
            container.appendChild(div);
        });

        document.getElementById('steps-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-step')) {
                event.target.parentElement.remove();
            }
        });
    </script>
</body>
</html>
