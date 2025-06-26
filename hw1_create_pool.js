document.querySelector("input[type=button]").addEventListener("click",aggiungi_opzione);


function aggiungi_opzione(event) {
    const nuova_opzione = document.createElement("input");
    const existingOptions = document.querySelectorAll("input[name='opzione[]']").length;
    const optionNumber = existingOptions + 1;
    // Create heading with proper numbering
    const heading = document.createElement("h3");
    heading.textContent = "Opzione " + optionNumber;
    nuova_opzione.setAttribute('type', 'text');
    nuova_opzione.setAttribute('name', 'opzione[]');
    const container = document.querySelector("form div");
    container.classList.remove("hidden");
    container.append(heading);
    container.append(nuova_opzione);    
}



function controllo(event) {
    const form = event.currentTarget;
    if(form.descrizione.value.length == 0 ||
        form.orario.value.length == 0 ||
        form.luogo.value.length == 0 ||
        form.data.value.length == 0 ||
        form.categoria.value.length == 0)
    {
        //avviso utente
        alert("Compilare tutti i campi");
        event.preventDefault();
        return;
    }
    
    // Check for empty options
    const options = form.querySelectorAll("input[name='opzione[]']");
    let emptyOptionsFound = false;
    
    for(let option of options) {
        if(option.value.trim().length === 0) {
            emptyOptionsFound = true;
            break;
        }
    }
    
    if(emptyOptionsFound) {
        alert("Tutte le opzioni devono essere compilate");
        event.preventDefault();
        return;
    }
}

document.querySelector('form[name="login"]').addEventListener("submit", controllo);

