<?php 
    session_start();
    if(isset($_POST['Exit'])){
        header('Location: index.php');
        session_abort();
    }
    else {
        echo 'Ошибка выхода';
    }

?>