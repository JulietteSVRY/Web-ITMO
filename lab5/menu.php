<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1:Menu</title>
    <link rel="stylesheet" href="styles/stylemenu.css?v=2">
</head>
<body>
<header>
    <div class="header_text"><a class="links" href="/lab5/index.php">На главную страницу</a></div>
    <div class="header_text">Доставка и оплата</div>
    <div class="header_text">Отзывы</div>
    <div class="header_text">Спецпредложения</div>
    <div class="header_text">Контакты</div>
    <div class="header_text"><a class="links" href="/lab5/cart.php?id=0">Корзина</a></div>
</header>

<?php
$connection = mysqli_connect("localhost:1337", "root", "", "items");
if ($connection -> connect_error) {
    die("Ошибка подклчюения к БД " . $connection -> connect_error);
}
$all = true;

if ($_SERVER['REQUEST_METHOD'] === "GET") {


    $idToCart =  $_GET['id'];
    for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ){
        if ($idToCart == $i) {
            $_SESSION["cart"][$i]++;
        }
    }
    if ($idToCart == -1) {
        for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ) {
            $_SESSION["cart"][$i] = 0;
        }
    }
    print("Данные из \$_SESSION['cart'], в которой хранятся данные о покупке: ");
    print_r($_SESSION["cart"]);
    print("</br>");
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $minCost = $_POST['minCost'];
    $maxCost = $_POST['maxCost'];
    $description = $_POST['description'];
    $whatPrintArray = array();
    $rememberFirst = 0;
    $rememberSecond = 0;

    if ($name != "") {
        $all = false;
        $queryName = "SELECT * FROM 'itemlist' WHERE name LIKE '%$name%' ";
        $result = $connection->query($queryName);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($whatPrintArray, $row['id']);
            }

        }
    }
    if ($minCost != "" || $maxCost != "") {
        $rememberFirst = count($whatPrintArray);
        if ($minCost == "") {
            $minCost = 0;
        }
        if ($maxCost == "") {
            $maxCost = 9999;
        }
        $all = false;
        $queryName = "SELECT * FROM 'itemlist' WHERE price >= $minCost AND price <= $maxCost ";
        $result = $connection->query($queryName);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($whatPrintArray, $row['id']);
            }

        }
    }

    if ($description != "") {
        $all = false;
        $rememberSecond = count($whatPrintArray);
        $descriptionArray = explode(" ", $description);
        for ($i = 0; $i < count($descriptionArray); $i++) {
            $queryName = "SELECT * FROM 'itemlist' WHERE description LIKE '%$descriptionArray[$i]%' ";
            $result = $connection->query($queryName);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($whatPrintArray, $row['id']);
                }
            }
        }

    }
}
?>
<a href="?cart=clean&id=-1">Очистить корзину</a>
<div class="main">
    <div class="searchOptions">
        <form action="/lab5/menu.php" method="POST">
            Поиск по названию товара:<input type ="text" name = "name" size="30" maxlength="30"/> <br>
            Диапозон цен: <input type="number" name = "minCost" max="9999" min="0" /> -
            <input type="number" name = "maxCost" max="9999" min="0"/> руб.<br>
            Поиск по описанию товара:<input type ="text" name = "description" size="30" maxlength="30"/> <br>
            <input type="submit" value="Поиск" />
        </form>
    </div>

    <div class="items">

        <?php
        if ($all === true) {
            $queryForAll = "SELECT * FROM 'itemlist'";
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
                        <div class="toCart">
                            <h3><a class="cartLink" href="?id=<?php echo $row['id']?>">Добавить в корзину</a></h3>
                        </div>
                    </div>

                    <?php
                }
            }
        } else {
            for ($i = 0; $i < count($whatPrintArray); $i++) {
                if ($rememberFirst != 0 && $rememberFirst == $i) {echo('<h2><b>Далее поиск по цене:</b></h2> </br>');}
                if ($rememberSecond != 0 && $rememberSecond == $i) {echo('<h2><b>Далее поиск по описанию:</b></h2> </br>');}
                $queryForSearch = "SELECT * FROM 'itemlist' WHERE id=$whatPrintArray[$i] ";
                $resultForSearch = $connection->query($queryForSearch);
                if ($resultForSearch->num_rows > 0) {
                    while($row = $resultForSearch->fetch_assoc()) {
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
                            <div class="toCart">
                                <h3><a class="cartLink" href="?id=<?php echo $row['id']?>">Добавить в корзину</a></h3>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
        }

        ?>
    </div>


    <?php
    $connection->close();
    ?>

</body>
</html>