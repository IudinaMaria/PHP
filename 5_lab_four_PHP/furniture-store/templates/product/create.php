<?php

$pdo = getPDO();

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];

unset($_SESSION['form_errors'], $_SESSION['form_old']);

?>

<main>
    <form class="max-w-lg mx-auto p-4 bg-white shadow-md rounded mt-5" method="post" action="?page=product-create">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
            <input type="text" id="title" name="title" class="shadow border rounded w-full py-2 px-3"
                   value="<?= htmlspecialchars($old['title'] ?? '') ?>">
            <?= getError($errors, 'title') ?>
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Product Category</label>
            <select id="category" name="category" class="shadow border rounded w-full py-2 px-3">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($old['category'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= getError($errors, 'category') ?>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Short Description</label>
            <textarea id="description" name="description" class="shadow border rounded w-full py-2 px-3"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            <?= getError($errors, 'description') ?>
        </div>

        <div class="mb-4">
            <label for="extended_description" class="block text-gray-700 text-sm font-bold mb-2">Extended Description</label>
            <textarea id="extended_description" name="extended_description" class="shadow border rounded w-full py-2 px-3"><?= htmlspecialchars($old['extended_description'] ?? '') ?></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="shadow border rounded w-full py-2 px-3"
                   value="<?= htmlspecialchars($old['price'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image URL</label>
            <input type="text" id="image" name="image" class="shadow border rounded w-full py-2 px-3"
                   value="<?= htmlspecialchars($old['image'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Tags (через запятую)</label>
            <input type="text" id="tags" name="tags" class="shadow border rounded w-full py-2 px-3"
                   value="<?= htmlspecialchars($old['tags'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <label for="steps" class="block text-gray-700 text-sm font-bold mb-2">Steps (через точку с запятой)</label>
            <input type="text" id="steps" name="steps" class="shadow border rounded w-full py-2 px-3"
                   value="<?= htmlspecialchars($old['steps'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <button type="submit" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">Create Product</button>
        </div>
    </form>
</main>
