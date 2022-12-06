<head>
<title>Подтвержение</title>
</head>
<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Login'])) {
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        //Подключение Google reCAPTCHA
        $error = true;
        $secret = '6LdOaVgjAAAAAIo0wsZLDsQ78iA6EK-ShVC8In6O';
        
        if (!empty($_POST['g-recaptcha-response'])) {
            $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, 'secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $out = curl_exec($curl);
            curl_close($curl);
            
            $out = json_decode($out);
            if ($out->success == true) {
                $error = false;
            } 
        }    
        //Подключение к базе данных
        $link = mysqli_connect("localhost","root","root","register") or die(mysqli_error($link));
        $query = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = mysqli_query($link,$query);
        //Закрепление id для других страниц
        global $id;

        while($row = $result->fetch_assoc())
        {
           $id = $row['id'];
           $password_hash = $row['password'];
        }
        //Проверка запроса
        if ($result->num_rows>0) {
            //Вывод ошибки reCAPTCHA
            if ($error){
                echo 'Ошибка заполнения капчи.';
                echo '<a href="index.php">Вернутся</a>';
            }
            //проверка пароля
            elseif (password_verify($password, $password_hash)) {
                $_SESSION['user_id'] = $id;
                header('Location: home.php');
            } else {
                echo '<p class="error"> Неверный пароль!</p>';
                echo '<a href="index.php">Вернутся</a>';
            }
        } else {
          echo '<p class="error">Неверная почта!</p>';
          echo '<a href="index.php">Вернутся</a>';
        }
    }
?>
