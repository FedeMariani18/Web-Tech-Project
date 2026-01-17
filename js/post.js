function createPost(post, utentePartecipa){
    const result = `
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="fw-bold">${post['titolo']}</h2>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="border bg-light d-flex align-items-center justify-content-center"
                style="height: 200px;">
            <img src="${post['foto']}" alt="Immagine del post" class="img-fluid h-100" style="object-fit: cover;">
            </div>
        </div>
        <div class="col-12 col-md-8">
            <h5>Descrizione</h5>
            <p class="text-muted">${post['descrizione']}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <p class="mb-1">
                <strong>Numero partecipanti iscritti:</strong> ${post['numero_partecipanti']}
            </p>
            <p class="mb-0">
                <strong>Partecipanti:</strong>
                <br>ORGANIZZATORE: <a href="profile.php?id=${post['creatore']['id']}">${post['creatore']['nome']} ${post['creatore']['cognome']}</a>
                ${getMembers(post)}
            </p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h5>Commenti</h5>

            <div class="card">
                <div class="card-body p-2"
                    style="max-height: 200px; overflow-y: auto;">
                    ${getComments(post)}
                </div>
            </div>

            <div class="input-group mt-2">
                <input type="text"
                    class="form-control"
                    placeholder="Scrivi qui il tuo commento">
                <button class="btn btn-outline-secondary">Invia</button>
            </div>
        </div>
    </div>

    ${getButtonToPartecipate(utentePartecipa)}
    `;
    return result;
}

function getButtonToPartecipate(utentePartecipa) {
    if (utentePartecipa) {
        return `
            <div class="row">
                <div class="col-12 d-grid">
                    <button class="btn btn-warning btn-lg fw-bold" id="disiscriviti" >
                        DISISCRIVITI
                    </button>
                </div>
            </div>
        `;
    }
    return `
        <div class="row">
            <div class="col-12 d-grid">
                <button class="btn btn-warning btn-lg fw-bold" id="partecipa">
                    PARTECIPA
                </button>
            </div>
        </div>
    `;
}

function getMembers(post) {
    let result = ``;
    for (let i=0; i < post['partecipanti'].length; i++) {
        let partecipant = `
            <br><a href="profile.php?id=${post['partecipanti'][i]['id']}">${post['partecipanti'][i]['nome']} ${post['partecipanti'][i]['cognome']}</a>
        `
        result += partecipant;
    }
    return result;
}

function getComments(post) {
    let result = "";
    for (let i=0; i < post['commenti'].length; i++) {
        let comment = `
            <div class="border-bottom pb-2 mb-2">
                <strong><a href="profile.php?id=${post['commenti'][i]['id_utente']}">${post['commenti'][i]['username']}</a></strong>
                <p class="mb-0 text-muted">${post['commenti'][i]['testo']}</p>
            </div>
        `
        result += comment;
    }
    return result;
}


async function getPostData() {
    const url = `api-post.php?id=${postId}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const profile = document.getElementById("profile");
        const profileImg = document.getElementById("profileImg");
        if (json['utenteLoggato']) {
            profile.href = "my-profile.php";
            profileImg.src = json['fotoProfilo'];
        } else {
            const like = document.getElementById("like");
            const notification = document.getElementById("notification");
            like.style.display = "none";
            notification.style.display = "none";
            profile.href = "login.php";
        }
        console.log(json);
        userId = json['id_utente'];
        const post = createPost(json['post'], json['utentePartecipa']);
        const main = document.querySelector("main");
        main.innerHTML += post;
        if (json['utentePartecipa']) {
            const btn2 = document.getElementById("disiscriviti");
            btn2.addEventListener("click", () => {
                removeParticipation();
        });
        } else {
            const btn1 = document.getElementById("partecipa");
            btn1.addEventListener("click", () => {
                insertNewPartecipation();
        });
        }
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();
let userId;

async function insertNewPartecipation() {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('partecipazione', "true");
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

        if(!json["iscrizioneRiuscita"]){
            document.querySelector("p").innerText = json["errore"];
        }
        if (json["iscrizioneRiuscita"]) {
            window.location.reload();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function removeParticipation() {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('partecipazione', "false");
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

        if(!json["disiscrizioneRiuscita"]){
            document.querySelector("p").innerText = json["errore"];
        }
        if (json["disiscrizioneRiuscita"]) {
            window.location.reload();
        }
    } catch (error) {
        console.log(error.message);
    }
}