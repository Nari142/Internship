<!DOCTYPE html>
<html>
    
<head>
    <title>Регистрация/Авторизация</title>
<link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
<script src="https://www.google.com/recaptcha/api.js"></script>

</head>

<body>
<div class="Registr">
    <h1>Регистрация</h1>
<form method="post" name="signup-form" action="register.php">
    <p >Имя: <input type="text" name="Name" class ="name" required/></p>

    <p >Телефон: <input type="tel" name="Phone" class ="Phone" pattern="8[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required/> </p>

    <p >Почта: <input type="email" name="Email" class="Email" required/></p>

    <p>Пароль: <input type="password" name="Password" class="Password" required/></p>

    <p >Повтор пароля: <input type="password" name="Password_confirm" class="Pawwrord" required/> </p>

    <p> <input type="submit" value="Авторизация" name="Register" /></p>
    
</form>
</div class = "Author">
<div class="Authorization">
    <h1>Авторизация</h1>
<form id="feedBackForm" method="post" action="login.php" name="signin-form">
    <p> Почта: <input type="email" name="Email" class="Email" required/></p>
  
    <p> Пароль: <input type="password" name="Password" class="Password" required/></p>

    <div class="g-recaptcha" data-sitekey="6LdOaVgjAAAAALnahRLH_ph7MicALzvfWQ0o7uPR"></div>
    <div class="text-danger" id="recaptchaError"></div>

    <p> <input type="submit" value="Вход" name="Login" /></p>
</form>
</div>

</body>



</html>

