document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("main form");
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    togglePassword.addEventListener("click", () => {
        const isHidden = passwordInput.type === "password";

        passwordInput.type = isHidden ? "text" : "password";
        eyeIcon.textContent = isHidden ? "Nascondi" : "Mostra";
    });

    
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const foto = document.querySelector("#foto").files[0];
        const nome = document.querySelector("#nome").value;
        const cognome = document.querySelector("#cognome").value;
        const username = document.querySelector("#username").value;
        const telefono = document.querySelector("#telefono").value;
        const mail = document.querySelector("#mail").value;
        const password = document.querySelector("#password").value;
        
        createAccount(foto, nome, cognome, username, telefono, mail, password);
    });
});

async function createAccount(foto, nome, cognome, username, telefono, mail, password) {
    const url = 'api-create-account.php';
    
    const formData = new FormData();
    formData.append('foto', foto);
    formData.append('username', username);
    formData.append('password', password);
    formData.append('nome', nome);
    formData.append('cognome', cognome);
    formData.append('telefono', telefono);
    formData.append('mail', mail);

    try {
        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);
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
