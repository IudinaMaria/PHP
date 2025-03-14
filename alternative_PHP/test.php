<?php
require_once 'process_test.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вечный слава тебе, полупокер ты наш</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Начать кринж тайм...</h2>

<form action="test.php" method="POST">
    <label>Как обращаться? (оставишь пустое место - будешь полупокером)</label>
    <input type="text" name="username" required>

    <?php 
    foreach ($questions as $index => $q): 
        if (empty($q["question"]) || empty($q["answers"])) continue;
    ?>
        <p><?php echo ($index + 1) . ". " .htmlspecialchars($q["question"]); ?></p>
        
        <?php 
        foreach ($q["answers"] as $key => $answer): 
            $inputType = htmlspecialchars($q["type"]); 
            $inputName = "answer[$index]";

            if ($inputType == 'checkbox') {
                $inputName .= '[]';
            }
        ?>
            <input type="<?= $inputType ?>" name="<?= $inputName ?>" value="<?= $key ?>"> 
            <?=htmlspecialchars($answer) ?><br>
        <?php endforeach; ?>
        <br>
    <?php endforeach; ?>

    <button type="submit">Закончить кринж-тайм</button>
</form>

</body>
</html>
