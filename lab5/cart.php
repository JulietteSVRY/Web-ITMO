<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 5:Cart</title>
    <link rel="stylesheet" href="styles/cart.css?v=2">
</head>
<body>
<header>
    <div class="header_text"><a class="links" href="/lab5/index.php">На главную страницу</a></div>
    <div class="header_text">Доставка и оплата</div>
    <div class="header_text">Отзывы</div>
    <div class="header_text">Спецпредложения</div>
    <div class="header_text">Контакты</div>
    <div class="header_text"><a class="links" href="/lab5/menu.php?id=0">Каталог</a></div>
</header>
<?php
//обращаемся к БД, чтобы вывести данные
$connection = mysqli_connect("localhost:1337", "root", "", "items");
if ($connection -> connect_error) {
    die("Ошибка подключения к БД " . $connection -> connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $idToCart =  $_GET['id'];
    if ($idToCart == -1) {
        for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ) {
            $_SESSION["cart"][$i] = 0;
        }
    }
    print("Данные из \$_SESSION['cart'], в которой хранятся данные о покупке: ");
    print_r($_SESSION["cart"]);
    print("</br>");
}
?>
<a href="?cart=clean&id=-1">Очистить корзину</a>
<div class="items">

    <?php
    $sum = 0;
    $amount = 0;

    for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ){
        $count = $_SESSION['cart'][$i];
        for ($j = 0; $j < $count; $j++) {
            $queryForAll = "SELECT * FROM 'itemlist' WHERE id=$i";
            $resultForAll = $connection->query($queryForAll);
            if ($resultForAll->num_rows > 0) {
                while($row = $resultForAll->fetch_assoc()) {
                    ?>

                    <div class="item">
                        <div class="item_pic">
                            <img src="<?php echo $row['img'] ?>" alt="Фото букета">
                        </div>
                        <div class="description">
                            <h2>Название: <?php echo $row['name'] ?></h2>
                            <h3>Цена: <?php echo $row['price'] ?> руб.</h3>
                            <h4>Описание: <?php echo $row['description'] ?></h4>
                        </div>
                    </div>




                    <?php


                    $sum = $sum + $row['price'];
                    $amount++;
                }
            }
        }
    }

    ?>
    <h1> Сумма к оплате: <?php echo($sum); ?> руб.,
        количество цветов: <?php echo($amount); ?> шт.</h1>

</div>
</body>
</html>