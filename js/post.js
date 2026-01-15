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
                <strong>Numero partecipanti iscritti:</strong> 4/10
            </p>
            <p class="mb-0">
                <strong>Partecipanti:</strong>
                //come aggiungo i partecipanti
            </p>
        </div>
    </div>

    <!-- Commenti -->
<div class="row mb-4">
    <div class="col-12">
        <h5>Commenti</h5>

        <!-- Riquadro commenti -->
        <div class="card">
            <div class="card-body p-2"
                 style="max-height: 200px; overflow-y: auto;">

                <div class="border-bottom pb-2 mb-2">
                    <strong>username</strong>
                    <p class="mb-0 text-muted">commento</p>
                </div>

                <div class="border-bottom pb-2 mb-2">
                    <strong>username</strong>
                    <p class="mb-0 text-muted">commento</p>
                </div>

                <div class="border-bottom pb-2 mb-2">
                    <strong>username</strong>
                    <p class="mb-0 text-muted">commento</p>
                </div>

                <div class="border-bottom pb-2 mb-2">
                    <strong>username</strong>
                    <p class="mb-0 text-muted">commento</p>
                </div>

            </div>
        </div>

        <!-- Scrivi commento -->
        <div class="input-group mt-2">
            <input type="text"
                   class="form-control"
                   placeholder="Scrivi qui il tuo commento">
            <button class="btn btn-outline-secondary">Invia</button>
        </div>
    </div>
</div>


    <!-- Pulsante partecipa -->
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

async function getPostData() {
    const url = `api-post.php?id=${postId}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const posts = createPost(json);

        const container = document.getElementById("posts-container");
        container.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();