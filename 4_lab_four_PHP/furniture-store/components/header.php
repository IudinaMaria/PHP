<?php !defined('PROJECT_NAME') && die(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PROJECT_NAME; ?></title>
    <link rel="stylesheet" href="./assets/styles/output.css">
</head>

<body class="bg-green-900">
    <header class="border border-gray-200 text-base bg-green-900 text-white">
        <div class="flex justify-between items-center px-16 py-4 font-medium">
            <h1 class="text-xl font-bold"><?php echo PROJECT_NAME; ?></h1>
            <nav class="flex justify-center gap-12 flex-grow">
                <h1 class="cursor-pointer hover:text-gray-300 transition">Products</h1>
                <h1 class="cursor-pointer hover:text-gray-300 transition">Orders</h1>
                <h1 class="cursor-pointer hover:text-gray-300 transition">Contacts</h1>
                <form action="search.php" method="GET" class="flex gap-1">
                    <input type="text" name="query" placeholder="Search..." class="border px-4 py-1 rounded">
                    <button type="submit" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">Search</button>
                </form>
            </nav>
            <a href="#" class="py-1 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">
                Login
            </a>
        </div>
    </header>
</body>