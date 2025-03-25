<?php

/**
 * Константа с названием проекта
 */
define('PROJECT_NAME', 'furniture-store');

// Подключаем необходимые файлы
require_once './data/furniture_products.php';
require_once './functions/template.php';
require_once './handlers/furniture-product-handler.php';
require_once './components/header.php';
?>

<main>
    <form class="max-w-lg mx-auto p-4 bg-white shadow-md rounded mt-5" method="post" action="/product-create.php">
        <!-- Название товара -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $_POST['name'] ?? ''; ?>">
            <?php echo getError($errors, 'name'); ?>
        </div>

        <!-- Основная категория товара -->
        <div class="mb-4">
            <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Product Category</label>
            <select id="categories" name="categories" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="furniture">Furniture</option>
                <option value="decor">Decor</option>
                <option value="appliances">Appliances</option>
                <option value="accessories">Accessories</option>
            </select>
            <?php echo getError($errors, 'categories'); ?>
        </div>

        <!-- Теги (множественный выбор) -->
        <div class="mb-4">
            <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Tags</label>
            <select id="tags" name="tags[]" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="modern">Modern</option>
                <option value="classic">Classic</option>
                <option value="minimalist">Minimalist</option>
                <option value="luxury">Luxury</option>
            </select>
            <?php echo getError($errors, 'tags'); ?>
        </div>

        <!-- Описание товара -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Product Description</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $_POST['description'] ?? ''; ?></textarea>
            <?php echo getError($errors, 'description'); ?>
        </div>

        <!-- Расширенное описание -->
        <div class="mb-4">
            <label for="extended_description" class="block text-gray-700 text-sm font-bold mb-2">Extended Description</label>
            <textarea id="extended_description" name="extended_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $_POST['extended_description'] ?? ''; ?></textarea>
            <?php echo getError($errors, 'extended_description'); ?>
        </div>

        <!-- Цена -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
            <input type="number" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $_POST['price'] ?? ''; ?>" step="0.01">
            <?php echo getError($errors, 'price'); ?>
        </div>

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

        <!-- Кнопка отправки -->
        <div class="mb-4">
            <button type="submit" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">Create Product</button>
        </div>
    </form>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const stepsContainer = document.getElementById("steps-container");
    const addStepButton = document.getElementById("add-step");

    addStepButton.addEventListener("click", function () {
        const stepDiv = document.createElement("div");
        stepDiv.classList.add("step", "flex", "gap-2", "mb-2");

        const input = document.createElement("input");
        input.type = "text";
        input.name = "steps[]";
        input.classList.add("shadow", "appearance-none", "border", "rounded", "w-full", "py-2", "px-3", "text-gray-700", "leading-tight", "focus:outline-none", "focus:shadow-outline");
        input.placeholder = "Enter step";

        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("remove-step", "bg-red-500", "text-white", "px-2", "rounded");
        removeButton.innerText = "✖";

        removeButton.addEventListener("click", function () {
            stepDiv.remove();
        });

        stepDiv.appendChild(input);
        stepDiv.appendChild(removeButton);
        stepsContainer.appendChild(stepDiv);
    });
});
</script>

<?php require_once './components/footer.php'; ?>
