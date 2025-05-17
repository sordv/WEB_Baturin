<?php
try {
    $db = new PDO("pgsql:host=localhost;port=5432;dbname=lb21", "postgres", "admin");
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>