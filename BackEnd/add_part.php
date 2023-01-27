<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    $sql = "CALL Dodaj".$_SESSION['part_category']." (".$_POST['chosen_part'].",".$_SESSION['config']." ) ";
    $result = mysqli_query($connect,$sql);
    header("Location: .\..\Pages\Subpages\config_page.php");
?>