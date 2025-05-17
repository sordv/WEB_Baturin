<?php
require_once 'db_connect.php';

$stmt = $db->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Батурин ЛБ-21</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p class="catalog_intro">КАТАЛОГ ТОВАРОВ</p>
    <div class="catalog">
        <?php foreach ($products as $product): 
            $avgRating = $db->query("SELECT AVG(rating) FROM reviews WHERE product_id = {$product['id']}")->fetchColumn();
            $avgRating = $avgRating ? round($avgRating, 1) : 0;
            $reviewCount = $db->query("SELECT COUNT(*) FROM reviews WHERE product_id = {$product['id']}")->fetchColumn();
        ?>
            <a href="product.php?id=<?= $product['id'] ?>" class="product_card">
                <img src="imgs/<?= $product['id'] ?>.jpg" alt="error">

                <div class="catalog_name">
                    <?php if ($reviewCount > 0): ?>
                        <span><?= $product['name'] ?></span>
                        <span><span class="star">★</span><?= $avgRating ?></span>
                    <?php else: ?>
                        <span><?= $product['name'] ?></span>
                    <?php endif; ?>
                </div>

                <p class="price"><?= $product['price'] ?> ₽</p>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>