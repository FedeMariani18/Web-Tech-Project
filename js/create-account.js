document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("main form");
    
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const nome = document.querySelector("#nome").value;
        const cognome = document.querySelector("#cognome").value;
        const username = document.querySelector("#username").value;
        const telefono = document.querySelector("#telefono").value;
        const password = document.querySelector("#password").value;
        
        createAccount(nome, cognome, username, telefono, password);
    });
});

async function createAccount(/*foto,*/ nome, cognome, username, telefono, /*mail,*/ password) {
    const url = 'api-create-account.php';
    
    const formData = new FormData();
    //formData.append('foto', foto);
    formData.append('username', username);
    formData.append('password', password);
    formData.append('nome', nome);
    formData.append('cognome', cognome);
    formData.append('telefono', telefono);
    //formData.append('mail', mail);
    
    try {
        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        if(json["creazioneeseguita"]){
            goToLogin();
        }
        else{
            //visualizza errore login
            document.querySelector("form > p").innerText = json["errorecreazione"];
        }

    } catch (error) {
        console.log(error.message);
    }
}

function goToLogin(){
    window.location.replace("login.php");
}
