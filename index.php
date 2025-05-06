<?php
$firstYear = date("Y");
include("secondYear.php");
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Батурин ЛБ-17</title>
    </head>
    <body>
        <?php
		
        echo "<h2>Задание 1:</h2>";
		
        $a = rand(-10, 10);
        $b = rand(-10, 10);
        echo "<p>Исходные значения: a = $a, b = $b</p>";
		
        if ($a >= 0 && $b >= 0) {
            echo "<p>Оба числа положительны - вывести разность</p>";
			$result = $a - $b;
        } elseif ($a < 0 && $b < 0) {
            echo "<p>Оба числа отрицательны - вывести произведение</p>";
			$result = $a * $b;
        } else {
            echo "<p>Числа разных знаков - вывести сумму</p>";
			$result = $a + $b;
        }
		
		echo "<p>Результат: $result</p>";

        echo "<h2>Задание 2:</h2>";
		
		$a = rand(0, 15);
		echo "<p>Исходное значение a: $a</p>";
		
		switch ($a) {
			case 0: echo "0, ";
			case 1: echo "1, ";
			case 2: echo "2, ";
			case 3: echo "3, ";
			case 4: echo "4, ";
			case 5: echo "5, ";
			case 6: echo "6, ";
			case 7: echo "7, ";
			case 8: echo "8, ";
			case 9: echo "9, ";
			case 10: echo "10, ";
			case 11: echo "11, ";
			case 12: echo "12, ";
			case 13: echo "13, ";
			case 14: echo "14, ";
			case 15: echo "15 ";
			break;
			default: echo "invalid value";
		}

        echo "<h2>Задание 3:</h2>";
		
		function sum($a, $b) {
			return $a + $b;
		}
		function subtract($a, $b) {
			return $a - $b;
		}
		function multiply($a, $b) {
			return $a * $b;
		}
		function divide($a, $b) {
			return $b != 0 ? $a / $b : "Ошибка: деление на ноль!";
		}
		
		$a = 8;
        $b = 2;
        echo "<p>Исходные значения: a = $a, b = $b</p>";
		
		echo "<p>Сложение: ".sum($a, $b)."</p>";
		echo "<p>Вычитание: ".subtract($a, $b)."</p>";
		echo "<p>Умножение: ".multiply($a, $b)."</p>";
		echo "<p>Деление: ".divide($a, $b)."</p>";
		
        echo "<h2>Задание 4:</h2>";
		
		function mathOperation($arg1, $arg2, $operation) {
			switch($operation) {
				case "sum": return sum($arg1, $arg2);
				case "subtract": return subtract($arg1, $arg2);
				case "multiply": return multiply($arg1, $arg2);
				case "divide": return divide($arg1, $arg2);
				default: return "operator not found";
			}
		}
		
		$arg1 = 12;
		$arg2 = 4;
		echo "<p>Исходные значения: arg1 = $arg1, arg2 = $arg2</p>";
		
		echo "<p>Сложение: ".sum($arg1, $arg2)."</p>";
		echo "<p>Вычитание: ".subtract($arg1, $arg2)."</p>";
		echo "<p>Умножение: ".multiply($arg1, $arg2)."</p>";
		echo "<p>Деление: ".divide($arg1, $arg2)."</p>";

        echo "<h2>Задание 5:</h2>";
		
		echo "<p>Получение текущего года разными способами:</p>";
		// в начале файла определяется переменная
		echo "<div>".$firstYear."</div>";
		// значение определяется в файле secondYear.php, который подключен к текущему файлу
		echo "<div>".$secondYear."</div>";
		// использование шаблонизатора (файл thirdYear.php)
		echo "<div><a href = 'thirdYear.php'>Третий способ</a></div>";
		
        echo "<h2>Задание 6:</h2>";
		
		function exponentiation($val, $pow) {
			if ($pow == 0) {
				return 1;
			}
			return $val * exponentiation($val, $pow - 1);
		}
		
		$a = 2;
		$b = 6;
		echo "<p>$a в степени $b: ".exponentiation($a, $b)."</p>";
		
		$a = 15;
		$b = 0;
		echo "<p>$a в степени $b: ".exponentiation($a, $b)."</p>";
		
        ?>
    </body>
</html>