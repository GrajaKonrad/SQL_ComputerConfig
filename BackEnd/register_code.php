<?php
    session_start();

    if(!isset($_POST['Login']) || !isset($_POST['Password']) || !isset($_POST['Repassword']))
    {
        exit;
    }
    $login = $_POST['Login'];
    $password = $_POST['Password'];

    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    $sql = "INSERT INTO uzytkownicy VALUES(default, '". $login. "', '". $password."');";
    mysqli_query($connect,$sql);
    mysqli_close($connect);
    $_SESSION["login"] = $login;
    
    header( "Location: ..\Pages\login.php" ); 
?>