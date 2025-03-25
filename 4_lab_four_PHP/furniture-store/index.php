<?php 

/**
 * Константа для названия проекта
 */
define('PROJECT_NAME', 'Furniture Store');

// Подключаем файл с данными о товарах
require_once './data/furniture_products.php';

/**
 * Подключаем компонент заголовка страницы
 */
require_once './components/header.php'; 

?>

<main class="container mx-auto">  <!-- Основной контейнер для контента страницы -->
    <h1 class="my-6 font-bold text-4xl font-mono text-white">Products</h1>
    
    <!-- Грид для отображения товаров -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <!-- Цикл для отображения всех товаров -->
        <?php foreach ($products as $id => $product) : ?>  
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <!-- Изображение товара -->
                <img class="w-60 h-60 object-cover rounded shadow-md" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">  
                
                <!-- Название товара -->
                <h1 class="text-xl font-medium text-white"><?php echo $product['name']; ?></h1>  
                
                <!-- Описание товара -->
                <p class="line-clamp-2 text-white"><?php echo $product['description']; ?></p>  
                
                <!-- Цена товара -->
                <p class="text-lg text-white font-bold "><?php echo '$' . number_format($product['price'], 2); ?></p>  
                
                <!-- Ссылка на подробную информацию о товаре -->
                <a class="text-white" href="/product.php?id=<?php echo $id + 1; ?>">Read more ...</a>  
            </div>
        <?php endforeach; ?>
        
        <!-- Блок для кнопки добавления нового товара -->
        <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
            <a href="/product-create.php">  <!-- Ссылка на страницу создания нового товара -->
                <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer text-white">
                    +
                </button>
            </a>
        </div>
    </div>
    
</main>

<?php 
/**
 * Подключаем компонент футера страницы
 */
require_once './components/footer.php'; 
?>  
