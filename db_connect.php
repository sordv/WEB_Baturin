<?php
try {
    $db = new PDO("pgsql:host=localhost;dbname=lb20", 'postgres', 'admin');
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>