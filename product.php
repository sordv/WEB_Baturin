<?php
require_once 'db_connect.php';

function getReviewWord($count) {
    if ($count >= 11 && $count <= 14) {
        return 'отзывов';
    } elseif ($count % 10 == 1) {
        return 'отзыв';
    } elseif ($count % 10 >= 2 && $count % 10 <= 4) {
        return 'отзыва';
    } else {
        return 'отзывов';
    }
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$productId = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: index.php");
    exit();
}

$reviewStmt = $db->prepare("SELECT * FROM reviews WHERE product_id = ?");
$reviewStmt->execute([$productId]);
$reviews = $reviewStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    $author = $_POST['author_name'];
    $rating = $_POST['rating'];
    $reviewText = $_POST['review_text'];
    
    if (!empty($author) && $rating >= 1 && $rating <= 5 && !empty($reviewText)) {
        $insertStmt = $db->prepare("INSERT INTO reviews (product_id, author_name, rating, review_text) VALUES (?, ?, ?, ?)");
        $insertStmt->execute([$productId, $author, $rating, $reviewText]);
        
        header("Location: product.php?id=$productId");
        exit();
    }
}

$avgRating = $db->query("SELECT AVG(rating) FROM reviews WHERE product_id = $productId")->fetchColumn();
$avgRating = $avgRating ? round($avgRating, 1) : 0;
$reviewCount = count($reviews);
$reviewWord = getReviewWord($reviewCount);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточка товара</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product_page">
        <a href="index.php" class="back_to_menu">< Назад</a>
        
        <div class="product">
            <img src="imgs/<?= $product['id'] ?>.jpg" alt="error" class="product_image">
            
            <div class="product_info">
                <h1><?= $product['name'] ?></h1>
                <p class="price"><?= $product['price'] ?> ₽</p>
                <p class="description"><?= $product['description'] ?></p>
                
                <div class="rating_section">
                    <?php if ($reviewCount > 0): ?>
                        <span class = "star">★</span> <?= $avgRating ?>/5 | <?= $reviewCount ?> <?= $reviewWord ?>
                    <?php else: ?>
                        Пока нет отзывов
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="reviews_section">
            <h2>Отзывы</h2>
            
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <strong><?= $review['author_name'] ?></strong>
                        <span class = "star">★</span><span class="rating"><?= $review['rating'] ?>/5</span>
                        <p><?= $review['review_text'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Пока тут пусто :(</p>
            <?php endif; ?>
            
            <div class="add_review">
                <h3>Оставить отзыв</h3>
                <form method="POST">
                    <div class="form_group">
                        <label for="author_name">Ваше имя:</label>
                        <input type="text" id="author_name" name="author_name" required>
                    </div>
                    
                    <div class="form_group">
                        <label for="rating">Оценка:</label>
                        <select id="rating" name="rating" required>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    
                    <div class="form_group">
                        <label for="review_text">Текст отзыва:</label>
                        <textarea id="review_text" name="review_text" required></textarea>
                    </div>
                    
                    <button type="submit" name="submit_review">Отправить отзыв</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>