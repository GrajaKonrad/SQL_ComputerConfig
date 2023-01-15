<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        header("Location: View_configs.php");
    }
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
        <script src=".\..\FrontEnd\login.js"></script>
    </head>
    <body>
        <div class="form_bracket">
            <span class="pure-menu-heading" style="font-size: x-large; padding-left: 0; padding-bottom: 2em;">Zaloguj</span>
            <form class="pure-form pure-form-aligned" action="..\BackEnd\login_code.php" method="post">
                <fieldset>
                    <div class="pure-control-group">
                        <label for="aligned-name">Login</label>
                        <input type="text" id="aligned-name" placeholder="Login" name = "Login" onfocusout="checkLogin()"/>
                    </div>
                    <div class="pure-control-group">
                        <label for="aligned-password">Hasło</label>
                        <input type="password" id="aligned-password" placeholder="Hasło" name = "Password" onfocusout="checkPassword()"/>
                    </div>
                    <div >
                        <button type="submit" class="pure-button pure-button-primary" id="login_button">Zaloguj</button>
                    </div>
                    <span><a href=".\Subpages\register.php">Nie masz konta ? Zarejestruj się</a></span>
                </fieldset>
            </form>
        </div>
    </body>
</html>
    