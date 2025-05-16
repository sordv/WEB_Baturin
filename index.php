<?php
require_once 'logs/logger.php';

function getImages($directory) {
    $images = [];
    $files = scandir($directory);
    foreach ($files as $file) {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $images[] = $file;
        }
    }
    return $images;
}

$imagesDir = 'imgs/images/';
$miniaturesDir = 'imgs/miniatures/';
$images = getImages($imagesDir);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Батурин ЛБ-19</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p class="name">Фотогалерея</p>
    
    <!-- Форма загрузки -->
    <div class="upload_form">
        <h2>Загрузить новое изображение</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/jpeg,image/png" required>
            <button type="submit">Загрузить</button>
        </form>
        <p>Максимальный размер файла: 2MB. Допустимые форматы: JPG, PNG.</p>
    </div>
    
    <!-- Галерея -->
    <div class="gallery">
        <?php if (empty($images)): ?>
            <p class="sad">Пока тут пусто :(</p>
        <?php else: ?>
            <?php foreach ($images as $image): ?>
                <div class="gallery_item">
                    <a href="<?= $imagesDir . $image ?>" target="_blank">
                        <img src="<?= $miniaturesDir . $image ?>" alt="<?= $image ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>