<?php

$pdo = getPDO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name
    FROM furniture_products p
    JOIN categories c ON p.category = c.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    echo "<h1 class='text-white text-center text-2xl mt-10'>Product not found</h1>";
    return;
}

$tags = json_decode($product['tags'], true) ?? [];
$steps = json_decode($product['steps'], true) ?? [];

?>

<article class="container mx-auto flex flex-col gap-6 mt-10 text-white max-w-3xl">
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="w-full h-96 object-cover rounded shadow-md">

    <h1 class="text-4xl font-bold"><?= htmlspecialchars($product['title']) ?></h1>
    <p class="text-gray-300 text-sm">Category: <?= htmlspecialchars($product['category_name']) ?></p>

    <p class="text-lg"><?= nl2br(htmlspecialchars($product['description'])) ?></p>

    <?php if (!empty($product['extended_description'])): ?>
        <div class="bg-gray-800 p-4 rounded">
            <h2 class="text-2xl font-semibold mb-2">Details</h2>
            <p><?= nl2br(htmlspecialchars($product['extended_description'])) ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($tags)): ?>
        <div>
            <h2 class="text-xl font-semibold mb-2">Tags</h2>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($tags as $tag): ?>
                    <span class="bg-green-700 px-3 py-1 rounded-full text-sm"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($steps)): ?>
        <div>
            <h2 class="text-xl font-semibold mb-2">Steps</h2>
            <ol class="list-decimal ml-6 space-y-1">
                <?php foreach ($steps as $step): ?>
                    <li><?= htmlspecialchars($step) ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endif; ?>

    <?php if ($product['price'] !== null): ?>
        <p class="text-xl font-bold">Price: $<?= number_format($product['price'], 2) ?></p>
    <?php endif; ?>

    <a href="/public/?page=product-edit&id=<?= $product['id'] ?>" class="text-yellow-400 hover:underline mt-6">✏️ Edit Product</a>
    <a href="/public/?page=index" class="text-blue-400 hover:underline mt-6">← Back to Products</a>
    <form method="post" action="/public/?page=product-delete&id=<?= $product['id'] ?>" onsubmit="return confirm('Are you sure you want to delete this product?');">
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-800">
        🗑 Delete Product
    </button>
</form>
</article>
