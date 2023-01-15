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
        <script src=".\..\..\FrontEnd\register.js"></script>
        <div class="form_bracket">
            <span class="pure-menu-heading" style="font-size: x-large; padding-left: 0; padding-bottom: 2em;">Rejestracja</span>
            <form class="pure-form pure-form-aligned" action="..\..\BackEnd\register_code.php" method="post">
                <fieldset>
                    <div class="pure-control-group">
                        <label for="aligned-name">Login</label>
                        <input type="text" id="aligned-name" name = "Login" placeholder="Login" onfocusout="checkLogin()" />
                    </div>
                    <div class="pure-control-group">
                        <label for="aligned-password">Hasło</label>
                        <input type="password" id="aligned-password" name = "Password" placeholder="Hasło" onfocusout="checkPassword()" />
                    </div>

                    <div class="pure-control-group">
                        <label for="aligned-repassword">Powtórz Hasło</label>
                        <input type="password" id="aligned-repassword" name = "Repassword" placeholder="Hasło" onfocusout="checkPassword()" />
                    </div>
                    <div>
                        <button type="submit" class="pure-button pure-button-primary" id="register_button">Zarejestruj</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
    
</html>
    