//PARTE RELATIVA a hw1_login.php

function controllo(event)   {
    const form = event.currentTarget;
    if(form.username.value.length == 0 ||
        form.password.value.length == 0)    {
            //avviso utente
            alert("Compilare tutti i campi");
        event.preventDefault();
    }
}


document.querySelector("form").addEventListener("submit", controllo);