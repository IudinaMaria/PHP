<?php

$dataFile = "data.json";

if (!file_exists($dataFile)) {
    echo "Файл данных не найден.";
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);
$questions = $data["questions"] ?? [];

if (empty($questions)) {
    echo "Нет вопросов для теста.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];

    $userAnswers = $_POST["answer"] ?? [];

    $correctCount = 0;
    $totalQuestions = count($questions);

    foreach ($questions as $index => $q) {
        $correct = $q["correct"]; 
        $userResponse = $userAnswers[$index] ?? [];

        if ($q["type"] === "checkbox") {
            sort($userResponse);
            sort($correct);
            if ($userResponse === $correct) {
                $correctCount++;
            }
        } else {
            if ($correct[0] == $userResponse) {
                $correctCount++;
            }
        }
    }

    $score = round(($correctCount / $totalQuestions) * 100, 2);

    $data["results"][] = [
        "username" => $username,
        "correct" => $correctCount,
        "score" => $score
    ];

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

    header("Location: result.php?correct=$correctCount&score=$score");
    exit;
}
