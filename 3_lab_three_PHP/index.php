<?php  
$dir = 'images/';

$files = scandir($dir);

if ($files === false) {
    echo "Ошибка: не удалось открыть папку с изображениями!";
    $files = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Б, initial-scale=1.0">
    <title>Porsche</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Porsche Gallery</h1>
        <p>Company | Products | Motorsports</p>
    </header>
    <main>
        <div class="gallery">
            <?php
            for ($i = 0; $i < count($files); $i++) {
                if ($files[$i] !== "." && $files[$i] !== ".." && preg_match('/\.(jpg|jpeg|png|gif)$/i', $files[$i])) {
                    $path = $dir . $files[$i];
            ?>
            <div class="image">
                <img src="<?php echo $path ?>" alt="Image">
            </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
    <footer>
        <p>© <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
