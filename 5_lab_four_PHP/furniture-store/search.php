<?php

define('PROJECT_NAME', 'Furniture Store');

require_once './data/furniture_products.php';

/**
 * Получение запроса поиска из GET-параметров
 * @var string $query Запрос пользователя в нижнем регистре и без пробелов по краям
 */
$query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

/**
 * Массив для хранения результатов поиска
 * @var array $results Найденные товары
 */
$results = [];

if ($query) {
    foreach ($products as $id => $product) {
        if (
            strpos(strtolower($product['name']), $query) !== false ||
            strpos(strtolower($product['description']), $query) !== false
        ) {
            $results[] = [
                'id' => $id,
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image' => $product['image']
            ];
        }
    }
}

require_once './components/header.php';
?>

<main class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold">Search Results</h1>

    <?php if (empty($results)) : ?>
        <p class="mt-4 text-gray-600">No results found for "<?php echo htmlspecialchars($query); ?>"</p>
    <?php else : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
            <?php foreach ($results as $result) : ?>
                <div class="border p-4 rounded shadow-md">
                    <img src="<?php echo htmlspecialchars($result['image']); ?>" alt="<?php echo htmlspecialchars($result['name']); ?>" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-xl font-medium mt-2"> <?php echo htmlspecialchars($result['name']); ?> </h2>
                    <p class="text-gray-600"> <?php echo htmlspecialchars($result['description']); ?> </p>
                    <p class="font-bold"> <?php echo '$' . number_format($result['price'], 2); ?> </p>
                    <a href="/product.php?id=<?php echo $result['id'] + 1; ?>" class="text-blue-600">View Product</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once './components/footer.php'; ?>
