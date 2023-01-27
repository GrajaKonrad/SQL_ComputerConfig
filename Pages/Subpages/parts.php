<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "projekt_sql");
    mysqli_set_charset($connect, 'utf8');
    if(isset($_POST['add_part']))
    {
        $_SESSION['part_category'] = $_POST['add_part'];
    }
    $sql = "SHOW COLUMNS FROM ".$_SESSION['part_category'];
    $resultColumns = mysqli_query($connect,$sql);
    $sql = "Select * From ". $_SESSION['part_category'].";";
    $resultValues = mysqli_query($connect,$sql);
    echo $_SESSION['part_category'];
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
                    <a class="pure-menu-heading" href="..\View_configs.php">Konfigurator PC</a>
                    <ul class="pure-menu-list">
                        <li class="pure-menu-item pure-menu-selected"><a href=".\config_page.php" class="pure-menu-link">Powrót do zestawu</a></li>
                        <li class="pure-menu-item pure-menu-selected"><a href="..\View_configs.php" class="pure-menu-link">Zestawy</a></li>
                        <li class="pure-menu-item pure-menu-selected"><a href="..\..\BackEnd\logout.php" class="pure-menu-link">Wyloguj</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <article>
            <form method="POST" action="..\..\Backend\add_part.php">
                <div style="height: 10vh;"></div>
                <table class="pure-table pure-table-horizontal centered_table" style="margin-left: 15%; margin-right: 15%; width: 70%;">
                    <thead>
                        <tr>
                            <th style="width: 3%;"/>
                            <?php 
                                $rows_width = 88 / mysqli_num_rows($resultColumns);
                                while($row = $resultColumns->fetch_assoc()){
                                    $columns[] = $row['Field'];
                                    if($row['Field'] == "Id")
                                    { 
                                        echo '<th style="width: 3%">'.$row['Field'].'</th>';
                                    }
                                    else
                                    {
                                        echo '<th style="width: '.$rows_width.'%; white-space: nowrap;">'.preg_replace('/(?<!\ |[A-Z])[A-Z]{1}/', ' $0', $row['Field']).'</th>';
                                    }
                                    
                                }
                            ?>
                            <th style="width: 3%;"/>
                            <th style="width: 3%;"/>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($row = mysqli_fetch_assoc($resultValues))
                            {
                                echo "<tr>";
                                echo '<td><input type="radio" name="chosen_part" value="'.$row['Id'].'"></input> </td>';
                                foreach ($columns as &$value)
                                {
                                    echo '<td>';
                                    echo  $row[$value];
                                    echo '</td>';
                                }
                                echo '<td><img src="..\..\images\pencil-square.svg" style="vertical-align: middle;"></img></td>';
                                echo '<td><img src="..\..\images\trash.svg" style="vertical-align: middle;"></img></td>';
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
                <div style="margin-right: 15%; text-align: right;">
                    <button class="pure-button pure-button-primary one_line_button">Usuń zaznaczenie</button>
                    <button class="pure-button pure-button-primary one_line_button" style="margin-left: 20px">Dodaj zaznaczone</button>
                </div>   
            </form> 
        </article>
    </body>
</html>