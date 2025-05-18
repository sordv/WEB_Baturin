<?php
require_once 'db_connect.php';

function structure(array $elems, $parentId = null) {
    $result = array();

    foreach ($elems as $el) {
        if ($el['parent_id'] == $parentId) {
            $child = structure($elems, $el['id']);
            if ($child) {
                $el['hasChildren'] = true;
                $el['items'] = $child;
            } else {
                $el['hasChildren'] = false;
                $el['items'] = array();
            }
            $result[] = $el;
        }
    }
    return $result;
}

$data = $db->query("SELECT id, parent_id, name FROM items ORDER BY id");
$data = $data->fetchAll(PDO::FETCH_ASSOC);
$menu = structure($data, null)[0];
$jsonData = json_encode($menu, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Батурин ЛБ-20</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="list_items"></div>

    <script>
        const menuData = <?php echo $jsonData; ?>;
    </script>
    <script src="script.js"></script>
</body>
</html>