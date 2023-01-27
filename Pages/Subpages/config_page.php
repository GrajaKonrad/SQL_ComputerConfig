<?php
    session_start();
    $is_new = true;
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    echo $_SESSION['config'];
    if ($_SESSION['config'] != "" || isset($_POST['edit_button']))
    {
        if( isset($_POST['edit_button']))
        {
            $_SESSION['config'] = $_POST['edit_button'];
        }
        $is_new = false;
        $sql = "
            SELECT
            konfiguracje.nazwa as knazwa,
            ChlodzenieCPU.Producent as CHCPUPro, ChlodzenieCPU.Model as CHCPUMode, 
            procesory.Producent as PROCPro, procesory.Model AS PROCMode,
            plytyglowne.Producent as MOBOPro, plytyglowne.Model AS MOBOMode,
            obudowa.Producent as CASEPro, obudowa.Model AS CASEMode,
            zasilacze.Producent as PSUPro, zasilacze.Model AS PSUMode,
            kartygraficzne.Producent as GPUPro, kartygraficzne.Model AS GPUMode,
            kartysieciowe.Producent as NETPro, kartysieciowe.Model AS NETMode,
            kartydzwiekowe.Producent as SOUNDPro, kartydzwiekowe.Model AS SOUNDMode
            FROM konfiguracje 
            Left JOIN ChlodzenieCPU ON konfiguracje.ChlodzenieCPU = ChlodzenieCPU.Id 
            Left JOIN Procesory ON konfiguracje.Procesor=Procesory.id
            Left JOIN plytyglowne ON konfiguracje.PlytaGlowna=plytyglowne.id
            Left JOIN obudowa ON konfiguracje.Obudowa=obudowa.id
            Left JOIN zasilacze ON konfiguracje.Zasilacz=zasilacze.id
            Left JOIN kartygraficzne ON konfiguracje.KartaGraficzna=kartygraficzne.id
            Left JOIN kartysieciowe on konfiguracje.KartaSieciowa=kartysieciowe.Id
            Left Join kartydzwiekowe on konfiguracje.KartaDzwiekowa=kartydzwiekowe.Id
            Where konfiguracje.Id like ('".$_SESSION['config']."')
            ";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        //load config setup
    }
    else
    {
        echo $_SESSION['id'] . "id";
        $sql = "
            INSERT INTO konfiguracje(Id, Nazwa, Uzytkownik)
            Values (default,'New configuration', ".$_SESSION['id'].");
        ";
        $result = mysqli_query($connect,$sql);
        $sql = "Select max(id) as new_id From konfiguracje Where Uzytkownik = ".$_SESSION['id']." and Nazwa like('New configuration');";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['config'] = $row['new_id'];
        
    }
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Konfigurator PC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Konfigurator systemów PC">
        <link rel="shortcut icon" type="image/ico" href="..\..\images\page_icon.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
        <link rel="stylesheet" href="..\..\Style\menu.css">
        <link rel="stylesheet" href="..\..\Style\custom_styles.css">
    </head>
    <body>
     <header>
            <div class="header" style="display: flexbox;">
                <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
                    <a class="pure-menu-heading"  href = "..\View_configs.php">Konfigurator PC</a>
                    <ul class="pure-menu-list">
                        <li class="pure-menu-item pure-menu-selected"><a href="..\View_configs.php" class="pure-menu-link">Zestawy</a></li>
                        <li class="pure-menu-item pure-menu-selected"><a href="..\..\BackEnd\logout.php" class="pure-menu-link">Wyloguj</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <article>
            <div style="height: 10vh;">
            </div>
            <form method="POST" action=".\..\..\BackEnd\ChangeConfigName.php">
            <div class="pure-menu-heading" style="text-align: center; font-size: 25px;">
                
                    <?php
                    if($is_new)
                    {
                        echo '<input type="text" id="aligned-name" value="New configuration" name = "Conf_name" style="text-align: center; padding: 5px; border-radius: 10px"/>';
                    }
                    else
                    {
                        echo '<input type="text" id="aligned-name" value="'.$row["knazwa"].'" name = "Conf_name" style="text-align: center; padding: 5px; border-radius: 10px"/>';
                    }
                    
                    ?>
                
            </div>
            <table class="centered_table conf_table">
                <tr><th></th><th></th></tr>
                    <tr><td>Płyta główna</td><td></td><td>Procesor</td></tr>
                <tr>
                    <td>
                        <table class="part_table">
                        <tr>
                        <form> </form>
                        <?php 
                            if($is_new || $row['MOBOPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "plytyglowne" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">';
                                echo '<img style="display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['MOBOMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['MOBOPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="PlytaGlowna"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                    <td style="width:35px"></td>
                    <td>                        
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['PROCPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "procesory" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['PROCMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['PROCPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="Procesor"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr><th></th><th></th></tr>
                    <tr><td>Zasilacz</td><td></td><td>Chłodzenie</td></tr>
                    <tr>
                    <td style="width: 47.5%">
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['PSUPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "zasilacze" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['PSUMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['PSUPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="Zasilacz"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                    <td style="width:5%"></td>
                    <td style="width: 47.5%">                        
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['CHCPUPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "chlodzeniecpu" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['CHCPUMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['CHCPUPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="ChlodzenieCPU"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr><th></th><th></th></tr>
                <tr><td>Karta Graficzna</td><td></td><td>Karta Dźwiękowa</td></tr>
                <tr>
                    <td>
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['GPUPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "kartygraficzne" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['GPUMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['GPUPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="KartaGraficzna"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                    <td style="width:35px"></td>
                    <td>                        
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['SOUNDPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "kartydzwiekowe" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['SOUNDMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['SOUNDPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="KartaDzwiekowa"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr><th></th><th></th></tr>
                <tr><td>Karta sieciowa</td><td></td><td>Obudowa</td></tr>
                <tr>
                    <td>
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['NETPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "kartysieciowe" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['NETMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['NETPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="KartaSieciowa"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                    <td style="width:35px"></td>
                    <td>                        
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['CASEPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="add_part" value = "obudowa" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                                echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['CASEMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['CASEPro'].'</td>';
                                echo '<form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="Obudowa"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form>';
                            }
                        ?>
                        </tr>
                        </table>
                    </td>
                </tr>  
            <tr style="height: 40px;"></tr>
            <tr><th></th><th></th></tr>
            <tr><td>Pamięć RAM</td><td></td><td>Pamięć systemu</td></tr>
            <?php
                    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
                    mysqli_set_charset($connect, 'utf8');
                    $sql = "
                        SELECT pamiecram.Producent as RamPRO, pamiecRam.model as RamMOD
                        FROM PamiecRAM
                        JOIN pamiecramkonfiguracji ON pamiecram.id = pamiecramkonfiguracji.PamiecRAM
                        JOIN konfiguracje ON pamiecramkonfiguracji.Konfiguracja = konfiguracje.Id
                        WHERE pamiecramkonfiguracji.konfiguracja =".$_SESSION['config'];
                    $resultRAM = mysqli_query($connect,$sql);
                    $sql = "
                        SELECT dyski.Producent as DysPRO, dyski.model as DysMOD
                        FROM Dyski
                        JOIN dyskikonfiguracji ON dyski.id = dyskikonfiguracji.dysk
                        JOIN konfiguracje ON dyskikonfiguracji.Konfiguracja = konfiguracje.Id
                        WHERE dyskikonfiguracji.konfiguracja =".$_SESSION['config'];
                    $resultDyski = mysqli_query($connect,$sql);
            ?>
            <tr>
                <td>
                    <table class="part_table">
                        <?php 

                            while($row = $resultRAM->fetch_assoc())
                            {
                                echo '<tr><td class="one_third_spacing">';
                                echo $row['RamMOD'];
                                echo '</td><td class="one_third_spacing">';
                                echo $row['RamPRO'];
                                echo '</td><form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="PlytaGlowna"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form></tr>';
                            }

                            echo '<td class="one_third_spacing"/>';
                            echo '<form method="POST" action=".\parts.php">';
                            echo '<td class="one_third_spacing">';
                            echo '<button name="add_part" value = "pamiecram" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                            echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                            echo '</button></td>';
                            echo '</form>';
                            echo '<td class="one_third_spacing"/>';
                        ?>
                    </table>
                </td>
                <td style="width:35px"></td>
                <td>                        
                    <table class="part_table">
                    <?php 
                            while($row = $resultDyski->fetch_assoc())
                            {
                                echo '<tr><td class="one_third_spacing">';
                                echo $row['DysMOD'];
                                echo '</td><td class="one_third_spacing">';
                                echo $row['DysPRO'];
                                echo '</td><form method="POST" action="..\BackEnd\remove_part.php">';
                                echo '<td class="one_third_spacing"><button name="part_type" value="PlytaGlowna"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></button></td>';
                                echo '</form></tr>';
                            }
                            echo '<td class="one_third_spacing"/>';
                            echo '<form method="POST" action=".\parts.php">';
                            echo '<td class="one_third_spacing">';
                            echo '<button name="add_part" value = "dyski" type="Submit" class="img_button" style="border: 0; padding: 0; text-align:centre;">'; 
                            echo '<img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                            echo '</button></td>';
                            echo '</form>';
                            echo '<td class="one_third_spacing"/>';
                        ?>
                    </table>
                </td>
            </tr>             
            </table>
            <button class="pure-button pure-button-primary centered_button"  onclick="location.href = '.\\Subpages\\config_page.php';">Zapisz konfigurację
                </button>
            </form>
        </article>
    </body>
</html>