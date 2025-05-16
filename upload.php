<?php

$imagesDir = 'imgs/images/';
$miniaturesDir = 'imgs/miniatures/';
$maxSize = 2 * 1024 * 1024;
$allowedExtensions = ['jpg', 'jpeg', 'png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] !== UPLOAD_ERR_OK) { die('Ошибка при загрузке файла!'); }

    if ($file['size'] > $maxSize) { die('Слишком большой файл!'); }

    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) { die('Недопустимое расширение файла!'); }
    
    $fileName = basename($file['name']);
    
    if (!move_uploaded_file($file['tmp_name'], $imagesDir . $fileName)) { die('Ошибка при сохранении файла!'); }
    
    createMiniature($imagesDir . $fileName, $miniaturesDir . $fileName, 300);
    header('Location: index.php');
    exit;
}

function createMiniature($src, $dest, $size) {
    list($width, $height, $type) = getimagesize($src);
    
    if ($type == IMAGETYPE_JPEG) { $source = imagecreatefromjpeg($src); }
    elseif ($type == IMAGETYPE_PNG) { $source = imagecreatefrompng($src); }
    else { return false; }
    
    if ($width > $height) {
        $srcX = ($width - $height) / 2;
        $srcY = 0;
        $srcW = $height;
        $srcH = $height;
    } else {
        $srcX = 0;
        $srcY = ($height - $width) / 2;
        $srcW = $width;
        $srcH = $width;
    }
    
    $miniature = imagecreatetruecolor($size, $size);
    
    imagecopyresampled($miniature, $source, 0, 0, $srcX, $srcY, $size, $size, $srcW, $srcH);
    
    if ($type == IMAGETYPE_JPEG) { imagejpeg($miniature, $dest, 90); }
    elseif ($type == IMAGETYPE_PNG) { imagepng($miniature, $dest, 9); }
    
    return true;
}
?>