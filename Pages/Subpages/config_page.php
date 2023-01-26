<?php
    session_start();
    $is_new = true;
    if (isset($_POST['edit_button']))
    {
        $_SESSION['config'] = $_POST['edit_button'];
        $is_new = false;
        $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
        //What have i done !!!!!!!!
        $sql = "
            SELECT
            konfiguracje.nazwa as knazwa,
            ChlodzenieCPU.Producent as CHCPUPRO, ChlodzenieCPU.Model as CHCPUMODE, 
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
            Where konfiguracje.Id like ('".$_POST['edit_button']."')
            ";
        $result = mysqli_query($connect,$sql);
        mysqli_close($connect);
        $row = mysqli_fetch_assoc($result);
        //load config setup
    }
    else
    {
        $_SESSION['config'] = "";
    }
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
                        <li class="pure-menu-item pure-menu-selected"><a href=".\config_page.php" class="pure-menu-link">Dodaj zestaw</a></li>
                        <li class="pure-menu-item pure-menu-selected"><a href="..\..\BackEnd\logout.php" class="pure-menu-link">Wyloguj</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <article>
            <div style="height: 10vh;">
            </div>
            <div class="pure-menu-heading" style="text-align: center; font-size: 25px;">
                <form>
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
                </form>
            </div>
            <table class="centered_table conf_table">
                <tr><th></th><th></th></tr>
                    <tr><td>Płyta główna</td><td></td><td>Procesor</td></tr>
                <tr>
                    <td>
                        <table class="part_table">
                        <tr>
                        <?php 
                            if($is_new || $row['PROCPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form method="POST" action=".\Subpages\parts.php">';
                                echo '<td class="one_third_spacing">';
                                echo '<button name="edit_button" value = "Procesor" type="Submit" class="img_button" style="border: 0; padding: 0;">';
                                echo '<img style="display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img>';
                                echo '</button></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['PROCMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['PROCPro'].'</td>';
                                echo '<form>';
                                echo '<td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td>';
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
                            if($is_new || $row['MOBOPro'] == NULL)
                            {
                                echo '<td class="one_third_spacing"/>';
                                echo '<form>';
                                echo '<td class="one_third_spacing"><img style="  display: block; margin-left: auto; margin-right: auto;" src="..\..\images\plus-circle.svg" style="vertical-align: middle;"></img></td>';
                                echo '</form>';
                                echo '<td class="one_third_spacing"/>';
                            }
                            else
                            {
                                echo '<td class="one_third_spacing">'.$row['MOBOMode'].'</td>';
                                echo '<td class="one_third_spacing">'.$row['MOBOPro'].'</td>';
                                echo '<form>';
                                echo '<td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td>';
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
                    <td>
                        <table class="part_table">
                            <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        </table>
                    </td>
                    <td style="width:35px"></td>
                    <td>                        
                        <table class="part_table">
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        </table>
                    </td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr><th></th><th></th></tr>
                <tr><td>Karta Graficzna</td><td></td><td>Karta Dźwiękowa</td></tr>
                <tr>
                    <td>
                        <table class="part_table">
                            <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        </table>
                    </td>
                    <td style="width:35px"></td>
                    <td>                        
                        <table class="part_table">
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        </table>
                    </td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr><th></th><th></th></tr>
                <tr><td>Karta sieciowa</td><td></td><td>Obudowa</td></tr>
            <tr>
                <td>
                    <table class="part_table">
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    </table>
                </td>
                <td style="width:35px"></td>
                <td>                        
                    <table class="part_table">
                    <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    </table>
                </td>
            </tr>   
            <tr style="height: 40px;"></tr>
            <tr><th></th><th></th></tr>
            <tr><td>Pamięć RAM</td><td></td><td>Pamięć systemu</td></tr>
            <tr>
                <td>
                    <table class="part_table">
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                        <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    </table>
                </td>
                <td style="width:35px"></td>
                <td>                        
                    <table class="part_table">
                    <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    <tr><td class="one_third_spacing">nazwa</td><td class="one_third_spacing">producent</td><td class="one_third_spacing"><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td></tr>
                    </table>
                </td>
            </tr>             
            </table>
            <button class="pure-button pure-button-primary centered_button"  onclick="location.href = '.\\Subpages\\config_page.php';">Zapisz konfigurację
                </button>
        </article>
    </body>
</html>