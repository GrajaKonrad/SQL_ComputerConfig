<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    $sql = "DELETE FROM konfiguracje WHERE Id = " . $_POST["delete_id"];
    $result = mysqli_query($connect,$sql);
    header("Location: .\..\Pages\View_configs.php");
?>