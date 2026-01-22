var userData;
const form = document.querySelector("form");
init();

async function init() {
    userData = await precompileForm();
    console.log("Dati dell'utente " , userData);  // userData contiene i dati normali, non una Promise

    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    togglePassword.addEventListener("click", () => {
        const isHidden = passwordInput.type === "password";

        passwordInput.type = isHidden ? "text" : "password";
        eyeIcon.textContent = isHidden ? "Nascondi" : "Mostra";
        passwordInput.focus();
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const foto = document.querySelector("#foto").files[0];
        const fotoOld = userData['foto'];  // Nome della foto vecchia per poterla cancellare
        console.log(fotoOld);
        const nome = document.querySelector("#nome").value;
        const cognome = document.querySelector("#cognome").value;
        const username = document.querySelector("#username").value;
        const telefono = document.querySelector("#telefono").value;
        const mail = document.querySelector("#mail").value;
        const password = document.querySelector("#password").value;
        

        updateAccount(userData['id'], foto, fotoOld, nome, cognome, username, telefono, mail, password);
    });
}

async function precompileForm(){
    const url = 'api-profile.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            if (response.status === 401 || response.status === 404) {
                window.location.href = "404.html";
                return;
            }
            throw new Error(`Response status: ${response.status}`);
        }

        userData = await response.json();

        document.getElementById("nome").value = userData['nome'];
        document.getElementById("cognome").value = userData['cognome'];
        document.getElementById("username").value = userData['username'];
        document.getElementById("telefono").value = userData['numero_telefono'];
        document.getElementById("mail").value = userData['mail'];

        //sistemo nome foto togliendo il path
        userData['foto'] = userData['foto'].split('/').pop();

        return userData;
    } catch (error) {
        console.log(error.message);
    }
}

async function updateAccount(id, foto, fotoOld, nome, cognome, username, telefono, mail, password){
    const url = 'api-edit-profile.php';
    const formData = new FormData();
    formData.append("id", id);
    if(foto != null){
        formData.append("foto", foto);
    }
    formData.append("fotoOld", fotoOld);  // Passa il nome della foto vecchia
    formData.append("nome", nome);
    formData.append("cognome", cognome);
    formData.append("username", username);
    formData.append("telefono", telefono);
    formData.append("mail", mail);
    formData.append("passwordOld", userData['password_hash']);
    if(password !== '') {
        formData.append("password", password);
    }

    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            if (response.status === 401 || response.status === 404) {
                window.location.href = "404.html";
                return;
            }
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);

        if(json['modificaeseguita']){
            window.location.href = "my-profile.php";
        } else {
            console.log(json['erroremodifica']);
        }

    } catch (error) {
        console.log(error.message);
    }
}