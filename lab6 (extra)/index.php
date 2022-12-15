<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab 6</title>
</head>
<body>

<?php
if(isset($_GET['page_layout'])){
    switch ($_GET['page_layout']){
        case 'list':
            require_once 'list.php';
            break;
        case 'create':
            require_once 'creation.php';
            break;
        case 'update':
            require_once 'update.php';
            break;
        case 'delete':
            require_once 'removal.php';
            break;
    }
}else{
    require_once 'list.php';
}
?>

</body>
</html>

