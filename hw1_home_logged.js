function onJSON(json) {
    const container = document.querySelector("#container");
    //svuoto container precedentemente acquisito
    container.innerHTML = '';
    for(sondaggio of json)  {
        const form = document.createElement("form");
        form.setAttribute('name', 'vota');
        form.setAttribute('action', "hw1_check_pool.php"); 
        form.setAttribute('method', 'GET');
        /*const input = document.createElement("input");
        input.setAttribute('type', 'submit');
        input.setAttribute('value', 'Vedi Andamento');
*/
        const hidden = document.createElement("input");
        hidden.setAttribute('type', 'hidden');
        hidden.setAttribute('name', 'id_sondaggio');
        hidden.setAttribute('value', sondaggio.Id);
 
        const mini_container = document.createElement("div");
        mini_container.classList.add("mini_container");
        const top = document.createElement("div");
        top.classList.add("top");
        const descrizione = document.createElement("em");
        descrizione.textContent = "Descrizione: "; 
        const descrizione_value = document.createElement("strong");
        descrizione_value.textContent = sondaggio.Descrizione + " ";
        const orario = document.createElement("em");
        orario.textContent = "Orario: ";
        const orario_value = document.createElement("strong");
        orario_value.textContent = sondaggio.Orario + " ";
        const luogo = document.createElement("em");
        luogo.textContent = "  Luogo: ";
        const luogo_value = document.createElement("strong");
        luogo_value.textContent = sondaggio.Luogo + " ";
        const down = document.createElement("div");
        down.classList.add("down");
        const categoria = document.createElement("em");
        categoria.textContent = "Categoria: "; 
        const categoria_value = document.createElement("strong");
        categoria_value.textContent = sondaggio.Categoria + " ";
        const votanti = document.createElement("em");
        votanti.textContent = "Votanti: ";
        const votanti_value = document.createElement("strong");
        votanti_value.textContent = sondaggio.N_Votanti + " ";
        const stato = document.createElement("em");
        stato.textContent = " Stato: ";
        const stato_value = document.createElement("strong");
        if(sondaggio.Stato = 1){
            stato_value.textContent = "Running ";
        }
        else{
            stato_value.textContent = "Ended ";
        }
        
        const list_item = document.createElement("li");
        list_item.textContent = sondaggio.Categoria;

        if(document.querySelector("ul").children.length == 0){
            document.querySelector("ul").appendChild(list_item);           
        }
        else{
            let flag = 0;
            for(let i = 0; i < document.querySelector("ul").children.length; i++){
                if(list_item.textContent == document.querySelector("ul").children[i].textContent){
                    flag = 1
                }
            };
            if(flag == 0){
                document.querySelector("ul").appendChild(list_item);
            }
        }

        

        top.appendChild(descrizione);
        top.appendChild(descrizione_value);
        top.appendChild(orario);
        top.appendChild(orario_value);
        top.appendChild(luogo);
        top.appendChild(luogo_value);
        down.appendChild(categoria);
        down.appendChild(categoria_value);
        down.appendChild(votanti);
        down.appendChild(votanti_value);
        down.appendChild(stato);
        down.appendChild(stato_value);
        mini_container.appendChild(top);
        mini_container.appendChild(down);
    //    mini_container.appendChild(input);
        mini_container.appendChild(hidden);
        form.appendChild(mini_container);
        container.appendChild(form);
    }
}

function responseAggiorna(response) {
    return response.json();
}

function aggiornaSondaggi() {
    //Richiedo la lista dei sondaggi
    fetch("hw1_get_logged.php").then(responseAggiorna).then(onJSON);
}

//carico inizialmente i sondaggi
aggiornaSondaggi();



function cerca(event){
    const cerca = document.querySelector("input[name='cerca']").value;
    const id = document.querySelector("input[name='id']").value;
    fetch("hw1_get_search.php?cerca="+cerca+"&id="+id).then(responseAggiorna).then(onJSON);  
    event.preventDefault();
}

document.querySelector("form[name='cerca']").addEventListener('submit', cerca);
