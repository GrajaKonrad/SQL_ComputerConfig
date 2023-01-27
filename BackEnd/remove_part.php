<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    $sql = "UPDATE konfiguracje SET " . $_POST["part_type"] . " = NULL WHERE Id = " . $_SESSION['config'];
    $result = mysqli_query($connect,$sql);
    header("Location: .\..\Pages\Subpages\config_page.php");
?>