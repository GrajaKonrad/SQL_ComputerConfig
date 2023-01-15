<?php
    session_start();
    unset($_SESSION['login']);
    header("Location: ..\Pages\Login.php");
?>