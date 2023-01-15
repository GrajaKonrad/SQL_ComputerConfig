<?php
    session_start();

    $login = $_POST['Login'];
    $password = $_POST['Password'];

    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    $sql = "Select Count(*) as liczba From uzytkownicy Where email like ('".$login."') and Haslo like ('".$password."') ;";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($connect);
    if($row['liczba'] == 1)
    {
        $_SESSION['login'] = $login;
        header("Location: .\..\Pages\View_configs.php");
    }
    header("Location: .\..\Pages\Login.php");
?>