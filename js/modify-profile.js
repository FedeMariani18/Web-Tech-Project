var userData;
const form = document.querySelector("form");
init();

async function init() {
    userData = await precompileForm();
    console.log(userData);  // userData contiene i dati normali, non una Promise

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const foto = document.querySelector("#foto").files[0] ?? userData['foto'];
        const nome = document.querySelector("#nome").value;
        const cognome = document.querySelector("#cognome").value;
        const username = document.querySelector("#username").value;
        const telefono = document.querySelector("#telefono").value;
        const mail = document.querySelector("#mail").value;
        const password = document.querySelector("#password").value == '' ? null : document.querySelector("#password").value;
        
        updateAccount(userData['id'], foto, nome, cognome, username, telefono, mail, password);
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

        return userData;
    } catch (error) {
        console.log(error.message);
    }
}

function logInfo(userData){
    console.log(userData);
}

async function updateAccount(id, foto, nome, cognome, username, telefono, mail, password){
    const url = 'api-modify-profile.php';
    const formData = new FormData();
    formData.append("id", id);
    formData.append("foto", foto);
    formData.append("nome", nome);
    formData.append("cognome", cognome);
    formData.append("username", username);
    formData.append("telefono", telefono);
    formData.append("mail", mail);
    formData.append("password", password);

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

        if(json['modificaeseguita'] === true){
            window.location.href = "my-profile.php";
        } else {
            console.log(json['erroremodifica']);
        }

    } catch (error) {
        console.log(error.message);
    }
}