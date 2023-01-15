<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    $sql = "Select Nazwa From konfiguracje join uzytkownicy on konfiguracje.Uzytkownik = uzytkownicy.id Where uzytkownicy.email like('".$_SESSION['login']."');";
    $result = mysqli_query($connect,$sql);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Konfigurator PC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Konfigurator systemów PC">
        <link rel="shortcut icon" type="image/ico" href="..\images\page_icon.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
        <link rel="stylesheet" href="..\Style\menu.css">
        <link rel="stylesheet" href="..\Style\custom_styles.css">
    </head>
    <body>
     <header>
            <div class="header" style="display: flexbox;">
                <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
                    <a class="pure-menu-heading" href="">Konfigurator PC</a>
                    <ul class="pure-menu-list">
                        <li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Dodaj konfigurację</a></li>
                        <li class="pure-menu-item pure-menu-selected"><a href="..\BackEnd\logout.php" class="pure-menu-link">Wyloguj</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <article>
            <div style="height: 10vh;"></div>
            <table class="pure-table pure-table-horizontal centered_table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nazwa konfiguracji</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<tr>';
                            echo '<td style="width: 3%;">'.$i.'</td>';
                            echo '<td>'.$row["Nazwa"].'</td>';
                            echo '<td style="width: 3%;"><img src="..\images\pencil-square.svg" style="vertical-align: middle;"></img></td>';
                            echo '<td style="width: 3%;"><img src="..\images\trash.svg" style="vertical-align: middle;"></img></td>';
                            $i++;
                        }
                    
                    ?>  
                </tbody>
            </table>
        
            <div>
                <button class="pure-button pure-button-primary centered_button">Dodaj konfigurację
                </button>
            </div>
        </article>
    </body>
</html>
