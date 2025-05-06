<?php
$thirdYear = date("Y");
$content = file_get_contents("index.html");

$content = str_replace("{{ thirdYear }}", $thirdYear, $content);

echo $content;
?>