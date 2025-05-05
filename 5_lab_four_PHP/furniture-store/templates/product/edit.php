<?php

$pdo = getPDO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT * FROM furniture_products WHERE id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    echo "<h1 class='text-white text-center'>Product not found</h1>";
    return;
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

?>

<main>
    <form class="max-w-lg mx-auto p-4 bg-white shadow-md rounded mt-5" method="post" action="?page=product-edit&id=<?= $id ?>">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Title</label>
            <input name="title" class="border rounded w-full py-2 px-3" value="<?= htmlspecialchars($product['title']) ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="category" class="border rounded w-full py-2 px-3">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" class="border rounded w-full py-2 px-3"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Extended Description</label>
            <textarea name="extended_description" class="border rounded w-full py-2 px-3"><?= htmlspecialchars($product['extended_description']) ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="number" name="price" step="0.01" class="border rounded w-full py-2 px-3" value="<?= $product['price'] ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Image</label>
            <input name="image" class="border rounded w-full py-2 px-3" value="<?= htmlspecialchars($product['image']) ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tags (comma)</label>
            <input name="tags" class="border rounded w-full py-2 px-3" value="<?= htmlspecialchars(implode(',', json_decode($product['tags'], true) ?? [])) ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Steps (semicolon)</label>
            <input name="steps" class="border rounded w-full py-2 px-3" value="<?= htmlspecialchars(implode(';', json_decode($product['steps'], true) ?? [])) ?>">
        </div>

        <button type="submit"
        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 border border-white">
    ✅ Update Product
</button>
    </form>
</main>
