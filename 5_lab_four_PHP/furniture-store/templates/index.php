<?php

$pdo = getPDO();

// Пагинация
$perPage = 5;
$page = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
$offset = ($page - 1) * $perPage;

// Получаем общее число товаров
$total = $pdo->query("SELECT COUNT(*) FROM furniture_products")->fetchColumn();
$totalPages = ceil($total / $perPage);

// Получаем текущие товары
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name 
    FROM furniture_products p
    JOIN categories c ON p.category = c.id
    ORDER BY p.created_at DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll();

?>

<main class="container mx-auto"> 
    <h1 class="my-6 font-bold text-4xl font-mono text-white">Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($products as $product): ?>  
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <img class="w-60 h-60 object-cover rounded shadow-md" 
                     src="<?= htmlspecialchars($product['image']) ?>" 
                     alt="<?= htmlspecialchars($product['title']) ?>">

                <h1 class="text-xl font-medium text-white"><?= htmlspecialchars($product['title']) ?></h1>  
                <span class="text-sm text-gray-300"><?= htmlspecialchars($product['category_name']) ?></span>

                <p class="line-clamp-2 text-white"><?= htmlspecialchars($product['description']) ?></p>  
                <p class="text-lg text-white font-bold"><?= '$' . number_format($product['price'], 2) ?></p>  

                <a class="text-white" href="?page=product&id=<?= $product['id'] ?>">Read more ...</a>  
            </div>
        <?php endforeach; ?>

        <!-- Кнопка добавления товара -->
        <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
        <a href="/public/?page=product-create">
                <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer text-white">
                    +
                </button>
            </a>
        </div>
    </div>
    <div class="mt-8 flex justify-center space-x-2">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=index&p=<?= $i ?>"
           class="px-4 py-2 rounded <?= $i === $page ? 'bg-white text-gray-900 font-bold' : 'bg-gray-700 text-white hover:bg-gray-600' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

</main>
