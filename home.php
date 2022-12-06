<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    }
    unset($_SESSION['name']);
    
?>

<head>
    <title>Главная</title>
</head>
<body>
<h1>Добро пожаловать зарегистрированный пользователь</h1>

    <?php 
    $id = $_SESSION['user_id'];
    $link = mysqli_connect("localhost","root","root","register") or die(mysqli_error($link));
    $query = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($link,$query);
    while($row = $result->fetch_assoc())
        {
           echo '<p> Имя: ', $row['username'], '</p>';
           echo '<p> Почта: ', $row['email'], '</p>';
           echo '<p> Телефон: ', $row['phone'], '</p>';
        }
    ?>

    <form method="POST" action="exit.php">
    
    <p> <input type="submit" value="Выход" name="Exit" /></p>
    </form>
    <h3>Изменение данных</h3>
    <form method="post" name="signup-form" action="update.php">
    <p >Имя: <input type="text" name="Name" class ="name"/></p>

    <p >Телефон: <input type="tel" name="Phone" class ="Phone" pattern="8[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" /> </p>

    <p >Почта: <input type="email" name="Email" class="Email" /></p>

    <p>Старый пароль: <input type="password" name="Password" class="Password" /></p>

    <p >Новый пароль: <input type="password" name="Password_new" class="Pawwrord" /> </p>

    <p> <input type="submit" value="Обновить данные" name="Update" /></p>
    
    </form>
</body>

