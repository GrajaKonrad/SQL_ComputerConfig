<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    $sql = "SELECT Id From ".$_POST['part_type']." where Producent like ('".$_POST['part_pro']."') AND Model like ('%".$_POST['part_mod']."%')";
    echo $sql;
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($_POST['part_type'] == "dyski")
    {
        $sql = "DELETE FROM dyskikonfiguracji Where Konfiguracja=".$_SESSION['config']." AND Dysk=".$row['Id'];
    }
    else
    {
        $sql = "DELETE FROM pamiecramkonfiguracji Where Konfiguracja=".$_SESSION['config']." AND PamiecRAM=".$row['Id'];
    }
    $result = mysqli_query($connect,$sql);
    mysqli_close($connect);
    echo $sql;
    header("Location: ..\Pages\Subpages\config_page.php");

    ?>
