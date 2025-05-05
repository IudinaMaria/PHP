<?php !defined('PROJECT_NAME') && die(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= PROJECT_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/output.css">
</head>
<body class="bg-green-900">
    <?php require __DIR__ . '/../components/header.php'; ?>

    <?= $content ?>

    <?php require __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
