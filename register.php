<head>
<title>Подтвержение</title>
</head>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Register'])) {
    //Получение данных с формы регистрации
    $username = $_POST['Name'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password_confirm = $_POST['Password_confirm'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    //Подключение к базе данных и создание запросов
    $link = mysqli_connect("localhost","root","root","register") or die(mysqli_error($link));
    $queryemail = "SELECT * FROM `users` WHERE `email`='$email'";
    $queryuser = "SELECT * FROM `users` WHERE `username` = '$username'";
    $queryphone = "SELECT * FROM `users` WHERE `phone` = '$phone'";
    $resultemail = mysqli_query($link,$queryemail);
    $resultuser = mysqli_query($link,$queryuser);
    $resultphone = mysqli_query($link,$queryphone);
    //Проверка почты
    if ($resultemail->num_rows>0) {
        echo '<p>Этот адрес уже зарегистрирован!</p>';
        echo '<a href="index.php">Вернутся</a>';
    }
    //Проверка имени
    elseif($resultuser->num_rows>0)
    {
        echo '<p>Это имя уже занято!</p>';
        echo '<a href="index.php">Вернутся</a>';
    }
    //Проверка номера телефона
    elseif($resultphone->num_rows>0)
    {
        echo '<p>Этот номер телефона уже занят!</p>';
        echo '<a href="index.php">Вернутся</a>';
    }
    //Проверка совпадения паролей
    elseif(strlen($password)!=0 and $password_confirm != $password) {
        echo '<p>Ошибка подтвержения пароля</p>';
        echo '<a href="index.php">Вернутся</a>';
    }
    //Создание запроса на добавление пользователя
    else {
        $query = "INSERT INTO `users`(`username`, `password`, `email`, `phone`) VALUES ('$username','$password_hash','$email','$phone')";
        $result = mysqli_query($link,$query);
        if ($result) {
            echo '<p>Регистрация прошла успешно!</p>';
            echo '<a href="index.php">Авторизируйтесь</a>';
        } else {
            echo '<p>Неверные данные</p>';
            echo '<a href="index.php">Вернутся</a>';
        }
    }
}
?>