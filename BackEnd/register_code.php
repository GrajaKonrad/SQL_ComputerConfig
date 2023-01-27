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
    $_SESSION["login"] = $login;
    $sql = "Select Id as liczba From uzytkownicy Where email like ('".$login."') and Haslo like ('".$password."') ;";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    mysqli_close($connect);
    
    header( "Location: ..\Pages\login.php" ); 
?>