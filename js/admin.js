const radio = document.querySelectorAll("input[type='radio']");

//cambia tabella al cambiamento dei radio button
radio.forEach(radio => {
    radio.addEventListener("change", function(event) {
        const container = document.querySelector("main");
        container.innerHTML = "";
        
        // Salva la scelta in localStorage
        localStorage.setItem('selectedTab', event.target.id);
        
        if(event.target.id === "utenti"){
            getUserData();
        } else {
            getPostData();
        }
    });
});

// Al caricamento della pagina, recupera la scelta salvata 
// (per impostare direttamente la tabella precedente)
const savedTab = localStorage.getItem('selectedTab') || 'utenti';
const selectedRadio = document.getElementById(savedTab);
if(selectedRadio) {
    selectedRadio.checked = true;
    // Simula il click per mostrare la tabella giusta
    selectedRadio.dispatchEvent(new Event('change'));
}

// Gestione dei click sui bottoni della tabella utenti
document.addEventListener("click", function(event) {
    // Controlla se il click è su un bottone
    if(event.target.classList.contains("btn")) {
        // Trova la riga della tabella (tr) più vicina
        const row = event.target.closest("tr");
        if(!row) return;
        
        // Ottieni i dati dalla riga
        const cells = row.querySelectorAll("td, th");
        const buttonText = event.target.textContent.trim();

        const table = document.querySelector("table");
        if(!table) return;
        
        // Determina se è una tabella di utenti o post
        if(table.id === "userTable") {
            // Tabella utenti
            const userId = cells[1].textContent;
            handleUserAction(buttonText, userId, row);
        } else if(table.id === "postTable") {
            // Tabella post
            const postId = cells[1].textContent;
            handlePostAction(buttonText, postId, row);
        }
    }
});


// USERS
function handleUserAction(action, userId, row) {
    //inidividua l'azione richiesta
    switch(action) {
        case "banna":
            deleteUser(userId);
            row.remove();
            break;
        case "visita":
            window.location.href = `profile.php?id=${userId}`;  //TODO: mettere a posto questa chiamata
            break;
        case "rimuovi admin ✘":
        case "rendi admin ✓":
            modifyAdmin(userId);
            //modifica il testo del bottone
            const thirdButton = row.querySelector("button:nth-child(3)");
            thirdButton.textContent = (thirdButton.textContent == "rimuovi admin ✘" ?
                 "rendi admin ✓" : "rimuovi admin ✘");
            break;
    }
}

async function getUserData() {
    const url = 'api-user.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const users = createUserRow(json['users']);
        const container = document.querySelector("main");
        container.innerHTML += users;
    } catch (error) {
        console.log(error.message);
    }
}

function createUserRow(users){
    let result = "";

    result += `
    <table class="table table-secondary table-hover" id="userTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id</th>
                    <th scope="col">username</th>
                    <th scope="col">nome</th>
                    <th scope="col">cognome</th>
                    <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>`;

    for(let i=0; i < users.length; i++){
        
        let admin = "null";
        if(users[i]["ruolo"] == "USER"){
            admin = "rendi admin ✓";
        } else {
            admin = "rimuovi admin ✘";
        }

        let postHTML = `
        <tr>
            <th scope="row">${i}</th>
            <td>${users[i]["id"]}</td>
            <th scope="row">${users[i]["username"]}</th>
            <td>${users[i]["nome"]}</td>
            <td>${users[i]["cognome"]}</td>
            <td>
                <div>
                    <button class="btn btn-secondary">banna</button>
                    <button class="btn btn-secondary">visita</button>
                    <button class="btn btn-secondary">${admin}</button>
                </div>
            </td>
        </tr>
        `;
        result += postHTML;
    }

    result += `
        </tbody>
    </table>`;
    return result;
}

//#region  action for user
async function deleteUser(userId) {
    // Implementa la logica per bannare l'utente
    const url = 'api-delete-user.php';
    const formData = new FormData();
    formData.append('id', userId);
    try {
        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });
        
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        if(!json["usereliminato"]) {
            console.log(json["errorecancellazione"]);
        } else {
            console.log(`Utente ${userId} eliminato con successo.`);
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function modifyAdmin(userId) {
    // Implementa la logica per rendere uno user admin
    const url = 'api-set-admin.php';
    const formData = new FormData();
    formData.append('id', userId);
    try {
        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });
        
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        if(!json["usermodificato"]) {
            console.log(json["erroremodifica"]);
        } else {
            console.log(`Utente ${userId} modificato con successo.`);
        }
    } catch (error) {
        console.log(error.message);
    }
}
//#endregion


// POSTS
function handlePostAction(action, postId, row) {
    switch(action) {
        case "elimina":
            deletePost(postId);
            row.remove();
            break;
        case "visita":
            window.location.href = `post.php?id=${postId}`;
            break;
    }
}

async function getPostData() {
    const url = 'api-posts.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const posts = createPostRow(json['posts']);
        const container = document.querySelector("main");
        container.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

function createPostRow(posts){
    let result = "";

    result += `
    <table class="table table-secondary table-hover" id="postTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id</th>
                    <th scope="col">titolo</th>
                    <th scope="col">organizzatore</th>
                    <th scope="col">data</th>
                    <th scope="col">categoria</th>
                    <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>`;

    for(let i=0; i < posts.length; i++){
        let postHTML = `
        <tr>
            <th scope="row">${i}</th>
            <td>${posts[i]["id"]}</td>
            <th scope="row">${posts[i]["titolo"]}</th>
            <td>${posts[i]["creatore"]}</td>
            <td>${posts[i]["data_ora"]}</td>
            <td>${posts[i]["nome_categoria"]}</td>
            <td>
                <div>
                    <button class="btn btn-secondary">elimina</button>
                    <button class="btn btn-secondary">visita</button>
                </div>
            </td>
        </tr>
        `;
        result += postHTML;
    }

    result += `
        </tbody>
    </table>`;
    return result;
}

async function deletePost(postId) {
    const url = 'api-delete-post.php';
    const formData = new FormData();
    formData.append('id', postId);
    try {
        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });
        
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        if(!json["posteliminato"]) {
            console.log(json["errorecancellazione"]);
        } else {
            console.log(`Post ${postId} eliminato con successo.`);
        }
    } catch (error) {
        console.log(error.message);
    }
}
