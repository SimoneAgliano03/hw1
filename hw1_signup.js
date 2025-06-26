function controllo(event)   {
    const form = event.currentTarget;
    if(form.username.value.length == 0 ||
        form.password.value.length == 0 ||
        form.conf_password.value.length == 0)    {
            //avviso utente
            alert("Compilare tutti i campi");
            event.preventDefault();
    }
    if( (form.password.value !== form.conf_password.value) ){
        //alert("Le Password inserite non corrispondono");
        const div = document.createElement('div');
        div.textContent = "Password debole, scegli almeno 5 caratteri";
        document.querySelector(".main_right").appendChild(div);
        event.preventDefault();
    }
 
 
    if(form.password.value.length < 5){
        const div = document.createElement('div');
        div.textContent = "Password debole, scegli almeno 5 caratteri";
        document.querySelector(".main_right").appendChild(div);
        event.preventDefault();
    }
 
}


document.querySelector("form").addEventListener("submit", controllo);