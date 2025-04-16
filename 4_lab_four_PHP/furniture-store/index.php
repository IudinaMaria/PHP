<?php 

define('PROJECT_NAME', 'Furniture Store');

require_once './data/furniture_products.php';

require_once './components/header.php'; 

?>

<main class="container mx-auto"> 
    <h1 class="my-6 font-bold text-4xl font-mono text-white">Products</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <?php foreach ($products as $id => $product) : ?>  
            <div class="flex flex-col gap-4 border border-gray-300 basis-md p-3 rounded-md">
                <img class="w-60 h-60 object-cover rounded shadow-md" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">  
                
                <h1 class="text-xl font-medium text-white"><?php echo $product['name']; ?></h1>  
                
                <p class="line-clamp-2 text-white"><?php echo $product['description']; ?></p>  
                
                <p class="text-lg text-white font-bold "><?php echo '$' . number_format($product['price'], 2); ?></p>  
                
                <a class="text-white" href="/product.php?id=<?php echo $id + 1; ?>">Read more ...</a>  
            </div>
        <?php endforeach; ?>
        
        <div class="border border-gray-200 p-4 rounded flex flex-col gap-4 col-span-1 items-center justify-center">
            <a href="/product-create.php">
                <button class="rounded-full flex items-center justify-center border border-gray-200 px-8 py-6
                        transition duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg cursor-pointer text-white">
                    +
                </button>
            </a>
        </div>
    </div>
    
<div class="mt-8 flex justify-center space-x-2">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>" class="px-4 py-2 rounded 
                <?php echo ($i == $currentPage) 
                    ? 'bg-white text-gray-900 font-bold' 
                    : 'bg-gray-700 text-white hover:bg-gray-600'; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>

</main>

<?php 
require_once './components/footer.php'; 
?>  
