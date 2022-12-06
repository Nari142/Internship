<head>
<title>Подтвержение</title>
</head>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Update'])) {

    $link = mysqli_connect("localhost","root","root","register") or die(mysqli_error($link));
    $username = $_POST['Name'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password_new = $_POST['Password_new'];
    //Получение всех данных из БД
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($link,$query);
    while($row = $result->fetch_assoc())
        {
           $password_ver = $row['password'];
           $username_ver = $row['username'];
           $email_ver = $row['email'];
           $phone_ver = $row['phone'];
        }
    //Изменение пароля
    if(strlen($password)>0 and strlen($password_new)>0 ){
        if (password_verify($password, $password_ver)){
            $password_hash = password_hash($password_new, PASSWORD_BCRYPT);
            $querypassw_new = "UPDATE `users` SET `password`='$password_hash' WHERE id ='$id'";
            $result_pass = mysqli_query($link,$querypassw_new);
            echo '<p>Пароль обнавлён</p>';
            echo '<a href="home.php">Назад</a>';
        }
        else {
            echo '<p>Не правильный старый пароль</p>';
        }
    }
    //Изменение имени
    if(strlen($username)>0) {
        $query_user = "UPDATE `users` SET `username`='$username' WHERE id ='$id'";
        $result_user = mysqli_query($link, $query_user);
        echo '<p>Имя обновлено</p>';
        echo '<a href="home.php">Назад</a>';
    }
    //Изменение почты
    if(strlen($email)>0) {
        $query_email = "UPDATE `users` SET `email`='$email' WHERE id ='$id'";
        $result_email = mysqli_query($link, $query_email);
        echo '<p>Почта обновлена</p>';
        echo '<a href="home.php">Назад</a>';
    }
    //Изменение телефона
    if(strlen($phone)>0) {
        $query_phone = "UPDATE `users` SET `phone`='$phone' WHERE id ='$id'";
        $result_phone = mysqli_query($link, $query_phone);
        echo '<p>Телефон обновлен</p>';
        echo '<a href="home.php">Назад</a>';
    }
}
?>