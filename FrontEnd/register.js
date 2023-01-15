function checkLogin()
{
    var login = document.getElementById("aligned-name");
    var button = document.getElementById("register_button");

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
    var repassword  = document.getElementById("aligned-repassword");
    var button = document.getElementById("register_button");

    if (password.value != "" && repassword.value != "" && password.value!=repassword.value)
    {
        password.style.borderColor  = "red";
        repassword.style.borderColor  = "red";
        button.disabled = true;
    }
    else
    {
        password.style.borderColor  = "#ddd";
        repassword.style.borderColor  = "#ddd";
        checkLogin();
    }
}