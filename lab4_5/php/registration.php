<style>@font-face {
        font-family: myFont;
        src: url("../css/KolkerBrush-Regular.ttf");
    }
    body{
        background-color:#B7F5BF ;
    }
    h1{
        font-family: myFont;
        font-size: 100px;
        text-align: center;
    }
    .buttons{
        text-align: center;
    }
    #back{
        float: left;
    }

    /* CSS */
    .button-30 {
        width: 300px;
        align-items: center;
        appearance: none;
        background-color: #FCFCFD;
        border-radius: 4px;
        border-width: 0;
        box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
        box-sizing: border-box;
        color: #36395A;
        cursor: pointer;
        display: inline-flex;
        font-family: "JetBrains Mono",monospace;
        height: 48px;
        justify-content: center;
        line-height: 1;
        list-style: none;
        overflow: hidden;
        padding-left: 16px;
        padding-right: 16px;
        position: relative;
        text-align: left;
        text-decoration: none;
        transition: box-shadow .15s,transform .15s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        will-change: box-shadow,transform;
        font-size: 18px;
    }

    .button-30:focus {
        box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    }

    .button-30:hover {
        box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        transform: translateY(-2px);
    }

    .button-30:active {
        box-shadow: #D6D6E7 0 3px 7px inset;
        transform: translateY(2px);
    }
    #requirements{
        font-family: Bahnschrift;
        text-align: right;
    }

</style>
<h1>Julia Net</h1>
<div class="buttons">
    <form action="../html/html.html">
        <button id="back" class="button-30">Назад</button><br><br>
    </form>
    <p id="requirements">
        Требования:<br>
        -Имя не должно содержать цифры и быть длиннее 15 символов<br>
        -Фамилия не должна содержать цифры и быть длиннее 15 символов<br>
        -Логин не должен содержать цифр и быть не длиннее 15<br>
        -Пароль должен содержать цифры, буквы и быть не длиннее 15<br>
    </p>
    <div class="inputs">
        <form method="post">
            <p>Имя</p><input type="text" name="name">
            <p>Фамилия</p><input type="text" name="surname">
            <p>Логин</p><input type="text" name="login">
            <p>Пароль</p><input type="text" name="password">

    </div>
        <input type="submit" name="register" class="button-30" value="Зарегистрироваться">
    </form>
</div>

<?php
$name = strip_tags($_POST["name"]);
$surname = strip_tags($_POST["surname"]);
$login=strip_tags($_POST["login"]);
$password=strip_tags($_POST["password"]);
$isAlright=false;
if (strlen($name)>15 || preg_match('[0-9]+', $name)){
    echo '<script> alert("Ошибка в поле имени")</script>';
}
else{
    if (strlen($surname)>15 || preg_match('[0-9]+', $surname)){
        echo '<script> alert("Ошибка в поле фамилии")</script>';
    }
    else{
        if (strlen($login)>15 || preg_match('[0-9]+', $login)){
            echo '<script> alert("Ошибка в поле логина")</script>';
        }
        else{
            if (strlen($password)>15 || !preg_match('[0-9]+', $password)){
               echo '<script> alert("Ошибка в поле пароля")</script>';
            }
            else{
                $isAlright = true;
            }
        }
    }
}




if (array_key_exists('register',$_POST)){
    if ($isAlright==true){
        header("Location: home.php");
        echo '<script> alert("До сюда дошло")</script>';
    }

}



?>