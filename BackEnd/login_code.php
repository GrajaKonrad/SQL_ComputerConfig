<?php
    session_start();

    $login = $_POST['Login'];
    $password = $_POST['Password'];

    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    $sql = "Select Count(*) as liczba From uzytkownicy Where email like ('".$login."') and Haslo like ('".$password."') ;";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row['liczba'] == 1)
    {
        $sql = "Select Id From uzytkownicy Where email like ('".$login."') and Haslo like ('".$password."') ;";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['Id'];
        header("Location: .\..\Pages\View_configs.php");

    }
    mysqli_close($connect);
    header("Location: .\..\Pages\Login.php");
?>