<?php

//таблица с расписанием

// функция, возвращает номер текущего дня
$dayOfWeek = date('N');

// с помощью тернарного оператора опредееляем в какие дни, что будет выводиться. Если 1,3, 5, то ... иначе ...
$johnSchedule = ($dayOfWeek == 1 || $dayOfWeek == 3 || $dayOfWeek == 5) ? "8:00-12:00" : "Нерабочий день";
$janeSchedule = ($dayOfWeek == 2 || $dayOfWeek == 4 || $dayOfWeek == 6) ? "12:00-16:00" : "Нерабочий день";

// таблица
echo "<h2>График работы</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>№</th><th>Фамилия Имя</th><th>График работы</th></tr>";
echo "<tr><td>1</td><td>John Styles</td><td>$johnSchedule</td></tr>";
echo "<tr><td>2</td><td>Jane Doe</td><td>$janeSchedule</td></tr>";
echo "</table>";

echo "<hr>";

//цикл for

echo "<h2>Цикл for</h2>";

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   $b += 5;
   echo "Шаг $i: a = $a, b = $b<br>";
}

echo "End of the loop: a = $a, b = $b<br><hr>";

//цикл while - так же, как и фор, но без счетчика по сути

echo "<h2>Цикл while</h2>";

$a = 0;
$b = 0;
$i = 0;

while ($i <= 5) {
   $a += 10;
   $b += 5;
   echo "Шаг $i: a = $a, b = $b<br>";
   $i++;
}

echo "End of the loop: a = $a, b = $b<br><hr>";

//цикл do-while по сути выполняет, потом проверяет условие

echo "<h2>Цикл do-while</h2>";

$a = 0;
$b = 0;
$i = 0;

do {
   $a += 10;
   $b += 5;
   echo "Шаг $i: a = $a, b = $b<br>";
   $i++;
} while ($i <= 5);

echo "End of the loop: a = $a, b = $b<br>";

?>
