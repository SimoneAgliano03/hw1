function controllo(event)   {
    const form = event.currentTarget;

    if(form.username.value.length == 0) {
            alert("Compilare il campo utente");
            event.preventDefault();
    }

    
}



function onJSON_aggiornaRisultati(json) {
    const id_sondaggio = document.querySelector("input[name='id']").value;
    
    
    document.querySelector("#sec_dettagli").classList.add("hidden");

    document.querySelector("#sec_risultati").classList.remove("hidden");

    document.querySelector("#sec_risultati").innerHTML = "";



    document.querySelector("#dettagli").classList.remove("underlined");
    
    document.querySelector("#risultati").classList.add("underlined");


    const container = document.createElement("div");
    container.classList.add("vote_container");

    document.querySelector("#sec_risultati").appendChild(container);


    for(content of json) {

       
        const mini_container = document.createElement("div");
        mini_container.classList.add("mini_container");

        
        const opzione = document.createElement("div");
        opzione.textContent = content.opzione + "";

        //barra che si riempie 

        const n_voti = document.createElement("em");
        n_voti.textContent = "Voti: "; 
        const n_voti_value = document.createElement("strong");
        n_voti_value.textContent = content.n_occ_voto + " ";


        const n_votanti = document.querySelector("input[name='n_vot']").value;

        const perc_voti = document.createElement("em");
        perc_voti.textContent = "Percentuale: "; 
        const perc_voti_value = document.createElement("strong");
        perc_voti_value.textContent = (100 * content.n_occ_voto / n_votanti) + "%  ";

        //container.appendChild(opzione);
        container.appendChild(mini_container);
        mini_container.appendChild(opzione);
        mini_container.appendChild(n_voti);
        mini_container.appendChild(n_voti_value);
        mini_container.appendChild(perc_voti);
        mini_container.appendChild(perc_voti_value);
    }

    
    document.querySelector('#risultati').removeEventListener("click", aggiornaRisultati);

    document.querySelector('#dettagli').addEventListener("click", aggiornaDettagli);

}






function aggiornaRisultati(){
    //ho come info: INPUT "HIDDEN" id.sondaggio e la sessione 
    const id_sondaggio = document.querySelector("input[name='id']").value;
    //Richiedo OPZIONI: partecipanti - opzione  
    fetch("hw1_get_results.php?id_sondaggio="+id_sondaggio).then(responseAggiorna).then(onJSON_aggiornaRisultati);
}

document.querySelector('#risultati').addEventListener("click", aggiornaRisultati);





function onJSON_aggiornaDettagli(json) {
    //const id_sondaggio = document.querySelector("input[name='id']").value;
    
    
    document.querySelector("#sec_risultati").classList.add("hidden");

    document.querySelector("#sec_dettagli").classList.remove("hidden");

    document.querySelector("#sec_dettagli").innerHTML = "";



    document.querySelector("#risultati").classList.remove("underlined");
    
    document.querySelector("#dettagli").classList.add("underlined");


    const container = document.createElement("div");
    container.classList.add("vote_container");

    document.querySelector("#sec_dettagli").appendChild(container);
    
    
    for(content of json.opzioni){
        const mini_container = document.createElement("div");
        mini_container.classList.add("mini_container");
        container.appendChild(mini_container);


        const div_opzione = document.createElement("div");
        div_opzione.textContent = content.Opzione;
        div_opzione.setAttribute('id', content.Opzione);

        mini_container.appendChild(div_opzione);    
    }

    for(content of json.utenti){
        const username = document.createElement("div");
        username.textContent = content.Username;
        document.getElementById(content.Opzione).appendChild(username);
    }


    document.querySelector('#dettagli').removeEventListener("click", aggiornaDettagli);

    document.querySelector('#risultati').addEventListener("click", aggiornaRisultati);

}



function aggiornaDettagli(){    
    const id_sondaggio = document.querySelector("input[name='id']").value;
    //Richiedo OPZIONI: partecipanti - opzione  
    fetch("hw1_get_details.php?id_sondaggio="+id_sondaggio).then(responseAggiorna).then(onJSON_aggiornaDettagli);
}




document.querySelector('#dettagli').addEventListener("click", aggiornaDettagli);
