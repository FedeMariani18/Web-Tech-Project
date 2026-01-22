function createPost(post, utentePartecipa, id_utente, likeUtente, admin){
    let date = new Date(post['data_ora']);

    const result = `
    <div class="row mb-3">
        <h2 class="fw-bold">${post['titolo']} ${getLikeButton(likeUtente, post, id_utente)}</h2>
    </div>
    <div class="row mb-2">
        <img class="col-12 rounded-5 col-md-6 mb-2 post-img" src="${post['foto']}" alt="Immagine del post"">
        <div class="col-12 col-md-6 fs-4">
            <h5 class="fs-3"><strong>Descrizione:</strong></h5>
            <p class="text-muted">${post['descrizione']}</p>
            <p class="mb-1 fs-4 mb-3">
                <strong>Data:</strong>
                <label class="text-muted">${date.toLocaleDateString()}</label></br>
                <strong>Ora:</strong>
                <label class="text-muted">${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}</label>
            </p>
            <p class="mb-1 fs-4 mb-3">
                <strong>Organizzatore:</strong>
                <label class="text-muted">${getCreator(post, id_utente)}</label>
            </p>
            <p>
                ${getButtonToPartecipate(utentePartecipa, id_utente, post['creatore']['id'], post['numero_partecipanti'], post['posti_disponibili'])}
            </p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <button class="btn btn-md btn-outline-secondary mb-2"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#partecipantiCollapse"
                    aria-expanded="false"
                    aria-controls="partecipantiCollapse">
                <strong>Partecipanti: ${post['numero_partecipanti']}/${post['posti_disponibili']}</strong>
            </button>
            <div class="collapse col-6" max-height=200px id="partecipantiCollapse">
                ${getMembers(post, id_utente)}
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <h5>Commenti</h5>

            <div class="card">
                <div class="card-body p-2"
                    style="max-height: 400px; overflow-y: auto;">
                    ${getComments(post, id_utente, admin)}
                </div>
            </div>
            ${getButtonForComment()}
            
            
        </div>
    </div>

    `;
    return result;
}

function getLikeButton(likeUtente, post, id_utente) {
    if (likeUtente == null || id_utente == post['creatore']['id']) {
        return "";
    }
    if (likeUtente) {
        return `
            <button class="btn btn-sm btn-outline-secondary mb-2" type="button" id="togliLike">
                <i id="like" class="bi bi-heart-fill text-black" aria-hidden="true"></i>
            </button>
        `;
    } else {
        return `
            <button class="btn btn-sm btn-outline-secondary mb-2" type="button" id="mettiLike">
                <i id="like" class="bi bi-heart text-black" aria-hidden="true"></i>
            </button>
        `;
    }
}

function getCreator(post, id_utente) {
    let redirect;
    if (id_utente == post['creatore']['id']) {
        redirect = "my-profile.php";
    } else {
        redirect = `profile.php?id=${post['creatore']['id']}`;
    }
    return `
        <a href="${redirect}" class="link-dark text-decoration-none">
            ${post['creatore']['nome']} ${post['creatore']['cognome']}
        </a>
    `;
}

function getButtonForComment() {
    if (userId != null) {
        return `
        <form>
            <div class="input-group mt-2">
                <input type="text" class="form-control" placeholder="Scrivi qui il tuo commento" id="commento">
                <button class="btn btn-secondary btn-lg w-3" type="submit" id="invia">Invia</button>
            </div>
        </form>
        `;
    } else {
        return "";
    }
}

function getButtonToPartecipate(utentePartecipa, id_utente, id_creatore, partecipanti, posti) {
    if (id_creatore == id_utente) {
        return `
            <div class="row">
                <div class="col-12 d-grid">
                    <button class="btn btn-warning btn-lg fw-bold important-button" id="elimina" >
                        ELIMINA POST
                    </button>
                </div>
            </div>
        `;
    }
    if (utentePartecipa) {
        return `
            <div class="row">
                <div class="col-12 d-grid">
                    <button class="btn btn-warning btn-lg fw-bold important-button" id="disiscriviti" >
                        DISISCRIVITI
                    </button>
                </div>
            </div>
        `;
    }
    if (posti <= partecipanti) {
        return "";
    }
    return `
        <div class="row">
            <div class="col-12 d-grid">
                <button class="btn btn-warning btn-lg fw-bold important-button" id="partecipa">
                    PARTECIPA
                </button>
            </div>
        </div>
    `;
}

function getMembers(post, id_utente) {
    let result = `<ul class="list-group mb-0">`;
    for (let i=0; i < post['partecipanti'].length; i++) {
        let redirect;
        if (id_utente == post['partecipanti'][i]['id']) {
            redirect = "my-profile.php";
        } else {
            redirect = `profile.php?id=${post['partecipanti'][i]['id']}`;
        }
        let partecipant = `
            <li class="list-group-item">
                <a href="${redirect}" class="link-secondary text-decoration-none" >
                    <img src="${post['partecipanti'][i]['foto']}" alt="Foto profilo" class="rounded-circle me-2" width="30" height="30">
                    ${post['partecipanti'][i]['nome']} ${post['partecipanti'][i]['cognome']}
                </a>
            </li>
        `

        result += partecipant;
    }
    return result;
}

function getComments(post, id_utente, admin) {
    let result = "";

    for (let i = 0; i < post['commenti'].length; i++) {
        const commento = post['commenti'][i];
        let redirect;
        if (id_utente == commento['id_utente']) {
            redirect = "my-profile.php";
        } else {
            redirect = `profile.php?id=${commento['id_utente']}`;
        }
        let deleteBtn = "";
        if (admin || id_utente == commento['id_utente']) {
            deleteBtn = `
                <button 
                    class="btn btn-danger btn-sm rounded-circle ms-2 delete-comment"
                    data-id="${commento['id']}"
                    title="Elimina commento">
                    ✕
                </button>
            `;
        }
        result += `
            <div class="border-bottom pb-2 mb-2 d-flex justify-content-between align-items-start">
                <div>
                    <strong>
                        <a href="${redirect}" class="link-secondary text-decoration-none">
                            <img src="${commento['foto_utente']}" alt="Foto profilo" class="rounded-circle me-2 border border-2" width="25" height="25">
                            ${commento['username']}
                        </a>
                    </strong>
                    <p class="mb-0 text-muted">${commento['testo']}</p>
                </div>
                ${deleteBtn}
            </div>
        `;
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

        const profile = document.getElementById("my-profile");

        userId = json['id_utente'];
        const post = createPost(json['post'], json['utentePartecipa'], json['id_utente'], json['likeUtente'], json['admin']);
        const main = document.querySelector("main");
        main.innerHTML = ''
        main.innerHTML += post;
        if (json['utenteLoggato']) {
            const like = document.getElementById("like");
            const notification = document.getElementById("notification");
            like.style.display = "flex";
            notification.style.display = "flex";

            const icon = document.getElementById("profileIcon");
            if(icon){
                const img = document.createElement("img");
                img.src = json['fotoProfilo'];
                img.id = "my-profile-img";
                img.alt = "Foto profilo utente";
                img.className = "rounded-circle border profile-hover";

                icon.replaceWith(img);
            }
            profile.href = "my-profile.php";
        }

        if (!json['likeUtente']) {
            const btn4 = document.getElementById("mettiLike");
            if (btn4) {
                btn4.addEventListener("click", () => {
                    addLike(json['post']['creatore']['id']);
                });
            }
        }
        if (json['likeUtente']) {
            const btn4 = document.getElementById("togliLike");
            if (btn4) {
                btn4.addEventListener("click", () => {
                    removeLike(json['post']['creatore']['id']);
                });
            }
        }
        if (json['utentePartecipa']) {
            const btn2 = document.getElementById("disiscriviti");
            if (btn2) {
                btn2.addEventListener("click", () => {
                    removeParticipation(json['post']['creatore']['id']);
                });
            }
        } else {
            const btn1 = document.getElementById("partecipa");
            if (btn1) {
                btn1.addEventListener("click", () => {
                    if (json['utenteLoggato']) {
                        insertNewPartecipation(json['post']['creatore']['id']);
                    } else {
                        window.location.replace("login.php");
                    }
                });
            } 
        }
        const btn3 = document.getElementById("invia");
        if (btn3) {
            btn3.addEventListener("click", () => {
                const testo = document.querySelector("#commento").value;
                sendComment(testo, json['post']['creatore']['id']);
            });
        }
        const btn5 = document.getElementById("elimina");
        if (btn5) {
            btn5.addEventListener("click", () => {
                removePost(json['post']['creatore']['id']);
            });
        }
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();
let userId;
let idCommento = null;

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-comment")) {
        idCommento = e.target.dataset.id;

        const modal = new bootstrap.Modal(
            document.getElementById("confirmDeleteModal")
        );
        modal.show()
    }
});
const confirmBtn = document.getElementById("confirmDeleteBtn");
if (confirmBtn) {
    confirmBtn.addEventListener("click", function () {
        if (idCommento) {
        removeComment(idCommento);
        idCommento = null;
    }
    const modalEl = document.getElementById("confirmDeleteModal");
    const modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
    });
}

async function removeComment(idCommento) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('idCommento', idCommento);
    formData.append('eliminaCommento', "true");
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

        if(json == "errore"){
            alert("Errore nell'eliminazione del commento");
        } else {
            getPostData();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function removePost(id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
        
    formData.append('id_post', postId);
    formData.append('creatore', id_creatore);
    formData.append('eliminaPost', "true");
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

        if(json == "errore"){
            alert("Errore nell'eliminazione del post");
        } else {
            window.location.replace("index.php");
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function addLike(id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('creatore', id_creatore);
    formData.append('like', "true");
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

        if(json == "errore"){
            alert("Errore nell'invio del like");
        } else {
            getPostData();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function removeLike(id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('creatore', id_creatore);
    formData.append('like', "false");
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

        if(json == "errore"){
            alert("Errore nell'eliminazione del like");
        } else {
            getPostData();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function sendComment(testo, id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('testo', testo);
    formData.append('creatore', id_creatore);
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

        if(json == "errore"){
            alert("Errore nell'invio del commento");
        } else {
            window.location.reload();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function insertNewPartecipation(id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('partecipazione', "true");
    formData.append('creatore', id_creatore);
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
            alert(json['errore']);
        }
        if (json["iscrizioneRiuscita"]) {
            getPostData();
            showBanner("Avvenuta iscrizione!");
            setTimeout(3000);
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function removeParticipation(id_creatore) {
    const url = 'api-post.php';
    const formData = new FormData();
    formData.append('id_utente', userId);
    formData.append('id_post', postId);
    formData.append('creatore', id_creatore);
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
           alert(json['errore']);
        }
        if (json["disiscrizioneRiuscita"]) {
            getPostData();
            showBanner("Avvenuta disiscrizione!");
            setTimeout(3000);
        }
    } catch (error) {
        console.log(error.message);
    }
}

function showBanner(message) {
    const banner = document.createElement('div');
    banner.className = 'popup success';
    banner.textContent = message;
    document.body.appendChild(banner);
    
    setTimeout(() => {
        banner.remove();
    }, 3000);
}