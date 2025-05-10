<?php
echo "<h2>Задание 1:</h2>";
		
function task1() {
	$a = 0;
	do {
		echo $a;
		
		if ($a == 0) { echo " - это ноль."; }
        elseif ($a % 2 === 0) { echo " - это четное."; }
        else { echo " - это нечетное."; };
				
		echo "<br>";
		$a++;
	} while ($a <= 10);
};
		
task1();

echo "<h2>Задание 2:</h2>";
		
$regions = [
	"Московская область" => ["Москва", "Зеленоград", "Клин"],
	"Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
	"Рязанская область" => ["Рязань", "Сасово", "Касимов"]
];

function task2($regions) {
	foreach ($regions as $region => $cities) {
		echo $region.":"."<br>";
		echo implode(", ", $cities).".";
		echo "<br>";
	};
};

task2($regions);

echo "<h2>Задание 3:</h2>";
		
function task3($target) {
	$letters = [
		"а" => "a",
		"б" => "b",
		"в" => "v",
		"г" => "g",
		"д" => "d",
		"е" => "e",
		"ё" => "yo",
		"ж" => "zh",
		"з" => "z",
		"и" => "i",
		"й" => "y",
		"к" => "k",
		"л" => "l",
		"м" => "m",
		"н" => "n",
		"о" => "o",
		"п" => "p",
		"р" => "r",
		"с" => "s",
		"т" => "t",
		"у" => "u",
		"ф" => "f",
		"х" => "h",
		"ц" => "ts",
		"ч" => "ch",
		"ш" => "sh",
		"щ" => "shch",
		"ъ" => "",
		"ы" => "y",
		"ь" => "",
		"э" => "e",
		"ю" => "yu",
		"я" => "ya",
	];
			
	$target = mb_strtolower($target);
	$result = strtr($target, $letters);
	return $result."<br>";
};
		
echo task3("яблоко");
echo task3("мандарин");
echo task3("виноград");

echo "<h2>Задание 4:</h2>";

$menu = [
	"Основная информация",
	"Фигуры" => [
		"Квадрат",
		"Круг",
		"Ромб"
	],
	"Цвета" => [
		"Теплые" => [
			"Красный",
			"Оранжевый"
		],
		"Синий"
	],
];

function task4($menu) {
    echo '<ul>';
	
    foreach ($menu as $key => $item) {
        if (is_array($item)) {
            echo '<li>'.$key.'</li>';
            task4($item);
        } else {
            echo '<li>'.$item.'</li>';
        }
    }
	
    echo '</ul>';
}

task4($menu);
		
echo "<h2>Задание 5:</h2>";
		
		
echo "<h2>Задание 6:</h2>";

function task6($regions, $letter) {
    $filteredRegions = [];
    
    foreach ($regions as $region => $cities) {
        $filteredCities = [];
        
        foreach ($cities as $city) {
            if (mb_strtolower(mb_substr($city, 0, 1)) === mb_strtolower($letter)) {
                $filteredCities[] = $city;
            }
        }
        
        if (!empty($filteredCities)) {
            $filteredRegions[$region] = $filteredCities;
        }
    }
    
    return $filteredRegions;
};

$filtered = task6($regions, "К");
task2($filtered);

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Батурин ЛБ-18</title>
    </head>
    <body>
    </body>
</html>