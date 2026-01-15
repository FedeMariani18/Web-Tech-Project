function createPost(post){
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

    <div class="row">
        <div class="col-12 d-grid">
            <button class="btn btn-warning btn-lg fw-bold">
                PARTECIPA
            </button>
        </div>
    </div>
    `;
    return result;
}

function getMembers(post) {
    let result = "";
    for (let i=0; i < post['partecipanti'].length; i++) {
        let partecipant = `
            <a href="profile.php?id=${post['partecipanti'][i]['id']}">${post['partecipanti'][i]['nome']} ${post['partecipanti'][i]['cognome']}</a>
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
        console.log(json);
        const post = createPost(json);
        const main = document.querySelector("main");
        main.innerHTML += post;
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();