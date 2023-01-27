<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    $sql = "Update konfiguracje Set Nazwa ='".$_POST['Conf_name']."' WHERE Id = ".$_SESSION['config'];
    $result = mysqli_query($connect,$sql);
    header("Location: .\..\Pages\View_configs.php");
    echo $sql;
?>