function checkLogin()
{
    var login = document.getElementById("aligned-name");
    var button = document.getElementById("login_button");

    if (login.value == "")
    {
        login.style.borderColor  = "red";
        button.disabled = true;
    }
    else
    {
        login.style.borderColor  = "#ddd";
        button.disabled = false;
    }
}

function checkPassword()
{
    var password = document.getElementById("aligned-password");
    var button = document.getElementById("login_button");

    if (password.value == "")
    {
        password.style.borderColor  = "red";
        button.disabled = true;
    }
    else
    {
        password.style.borderColor  = "#ddd";
        checkLogin()
    }
}