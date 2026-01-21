function createProfile(user){
    const result = `
    <div class="row justify-content-center m-0">

        ${getAdminButton(user)}

        <div class="container-fluid mt-4 mb-5">
        
            <h2 class="fs-2 fw-bold">Info</h2>

            <div class="row g-3 mt-3">

                <div class="col-12 col-md-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-muted">Nome</span>
                            <span class="fw-bold">${user['nome']}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-muted">Cognome</span>
                            <span class="fw-bold">${user['cognome']}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-muted">Email</span>
                            <span class="fw-bold">${user['mail']}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-muted">Telefono</span>
                            <span class="fw-bold">${user['numero_telefono']}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center m-0 w-100">
            <h2 class="fs-2 fw-bold col-12">Post attivi:</h2>
            ${getActivePost(user)}
        </div>
        <div class="row justify-content-center m-0 w-100">
            <h2 class="fs-2 fw-bold col-12">Post a cui partecipi:</h2>
            ${getPost(user)}
        </div>

    </div>
    `;
    return result;
}

function getAdminButton(user) {
    if (user['ruolo'] == "ADMIN") {
        return `
            <div class="col-12 col-md-6 mb-4 mt-3">
                <button class="w-100 btn btn-light border rounded-4 shadow-sm" onclick="window.location.href='admin.php'">
                    OPERAZIONI ADMIN
                </button>
            </div>
        `;
    }
    return "";
}

function getPost(user) {
    let result = "";
    if (user['postACuiPartecipa'].length == 0) {
        return `Non partecipi a nessun evento.`;
    }
    for(let i=0; i < user['postACuiPartecipa'].length; i++){
        let date = new Date(user['postACuiPartecipa'][i]["data_ora"]);
        let postHTML = `
        <div class="col-10 col-lg-3 p-3 p-md-4">
            <a class="flex-container link-underline link-underline-opacity-0 text-reset" href="post.php?id=${user['postACuiPartecipa'][i]["id"]}">
                <article class="row rounded-5 border border-black border-1 ">
                    <img class="img-fluid p-0" src="${user['postACuiPartecipa'][i]["foto"]}" alt="immagine del annuncio">
                    <div class="">
                        <h4 class="card-title m-0">${user['postACuiPartecipa'][i]["titolo"]}</h4>
                        <p class="card-text m-0">${date.toLocaleDateString()} - ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}</p>
                        <p class="card-text text-secondary m-0">partecipanti: ${user['postACuiPartecipa'][i]["numero_iscritti"]}/${user['postACuiPartecipa'][i]["posti_disponibili"]}</p>
                        
                    </div>
                </article>
            </a>
        </div>
        `;
        result += postHTML;
    }
    return result;
}

function getActivePost(user) {
    let result = "";
    if (user['postAttivi'].length == 0) {
        return `Non hai nessun post attivo`;
    }
    for(let i=0; i < user['postAttivi'].length; i++){
        let date = new Date(user['postACuiPartecipa'][i]["data_ora"]);
        let postHTML = `
        <div class="col-10 col-lg-3 p-3 p-md-4">
            <a class="flex-container link-underline link-underline-opacity-0 text-reset" href="post.php?id=${user['postACuiPartecipa'][i]["id"]}">
                <article class="row rounded-5 border border-black border-1 ">
                    <img class="img-fluid p-0" src="${user['postACuiPartecipa'][i]["foto"]}" alt="immagine del annuncio">
                    <div class="">
                        <h4 class="card-title m-0">${user['postACuiPartecipa'][i]["titolo"]}</h4>
                        <p class="card-text m-0">${date.toLocaleDateString()} - ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}</p>    
                    </div>
                </article>
            </a>
        </div>
        `;
        result += postHTML;
    }
    return result;
}

async function getUserData() {
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
        const json = await response.json();
        console.log(json);
        const profileImg = document.getElementById("profileImg");
        profileImg.src = json['foto'];
        const username = document.getElementById("username");
        username.innerText = json['username'];
        const profile = createProfile(json);
        const main = document.querySelector("main div");
        main.innerHTML += profile;
    } catch (error) {
        console.log(error.message);
    }
}

async function logout(){
    const url = 'api-logout.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);

        if(json['logouteseguito'] === true){
            window.location.href = "index.php";
        } else {
            console.log(json['errorelogout']);
        }
    } catch (error) {
        console.log(error.message);
    }
}

getUserData();