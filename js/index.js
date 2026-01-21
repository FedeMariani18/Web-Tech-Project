function createPost(posts){
    let result = "";

    for(let i=0; i < posts.length; i++){
        let date = new Date(posts[i]["data_ora"]);

        let postHTML = `
        <div class="col-10 col-md-5 col-lg-4 col-xl-3 p-3 p-md-4">
            <a class="flex-container link-underline link-underline-opacity-0 text-reset" href="post.php?id=${posts[i]["id"]}">
                <article class="row rounded-5 border border-black border-0 ">
                    <img class="img-fluid p-0" src="${posts[i]["foto"]}" alt="immagine del annuncio">
                    <h4 class="card-title m-0 text-truncate">${posts[i]["titolo"]}</h4>
                    <p class="card-text m-0">${date.toLocaleDateString()} - ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}</p>
                    <p class="card-text text-secondary m-0">partecipanti: ${posts[i]["numero_iscritti"]}/${posts[i]["posti_disponibili"]}</p>   
                
                </article>
            </a>
        </div>
        `;
        result += postHTML;
    }
    return result;
}

function createUser(users, id_user_logged){
    let result = "";

    for(let i=0; i < users.length; i++){
        let redirect = "";
        if(users[i]["id"] === id_user_logged){
            redirect = "my-profile.php";
        } else {
            redirect = `profile.php?id=${users[i]["id"]}`;
        }

        let postHTML = `
        <div class="col-10 col-md-5 col-lg-4 col-xl-3 p-3 p-md-4">
            <a class="flex-container link-underline link-underline-opacity-0 text-reset" href="${redirect}">
                <article class="row rounded-5 border border-black border-1 ">
                    <img class="img-fluid p-0" src="${users[i]["foto"]}" alt="immagine del annuncio">
                    <div class="">
                        <h4 class="card-title m-0 text-truncate">${users[i]["username"]}</h4>
                        <p class="card-text m-0">${users[i]["nome"]} ${users[i]["cognome"]}</p>
                    </div>
                </article>
            </a>
        </div>
        `;
        result += postHTML;
    }
    return result;
}

async function getPostData() {
    const url = 'api-post.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();

        const profile = document.getElementById("profile");

        if (json['utenteLoggato']) {
            const like = document.getElementById("like");
            const notification = document.getElementById("notification");
            const create = document.getElementById("createPost");
            like.style.display = "flex";
            notification.style.display = "flex";
            create.style.display = "block";

            const icon = document.getElementById("profileIcon");
            if(icon){
                const img = document.createElement("img");
                img.src = json['fotoProfilo'];
                img.id = "profileImg";
                img.alt = "Foto profilo utente";
                img.className = "rounded-circle border profile-hover";

                icon.replaceWith(img);
            }
            profile.href = "my-profile.php";
        }

        const postsHTML = createPost(json['post']);
        const container = document.getElementById("posts-container");
        container.innerHTML = postsHTML;

    } catch (error) {
        console.log(error.message);
    }
}

getPostData();



// Search functionality

async function search(query) {
    const url = 'api-search.php?query=' + encodeURIComponent(query);
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();

        if(json["searchsuccess"]){
            // USERS
            const userContainer = document.getElementById("users-container");
            const userTitle = document.getElementById("userTitle");

            if (json['users'] && json['users'].length > 0) {
                userTitle.textContent = "Utenti trovati:";
                userContainer.innerHTML = createUser(json['users'], json['id_utente']);
            } else {
                console.log("No users found");
                userContainer.innerHTML = "";
                userTitle.textContent = "Nessun utente trovato";
            }

            // POSTS
            const postContainer = document.getElementById("posts-container");
            const postTitle = document.getElementById("postTitle");

            if (json['posts'] && json['posts'].length > 0) {
                postTitle.textContent = "Post trovati:";
                postContainer.innerHTML = createPost(json['posts']);
            } else {
                console.log("No posts found");
                postContainer.innerHTML = "";
                postTitle.textContent = "Nessun post trovato";
            }
        }
        else{
            const userContainer = document.getElementById("users-container");
            const userTitle = document.getElementById("userTitle");
            userContainer.innerHTML = "";
            userTitle.textContent = "Nessun utente trovato";
            const postContainer = document.getElementById("posts-container");
            const postTitle = document.getElementById("postTitle");
            postContainer.innerHTML = "";
            postTitle.textContent = "Nessun post trovato";
        }
    } catch (error) {
        console.log(error.message);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#searchForm");
    const label = document.querySelector("#search");
    if(form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const searchQuery = label.value;
            search(searchQuery);
            label.value = "";
        });
    }
});

function showErrorToast(message) {
    const toast = document.querySelector("#toast-error");
    toast.textContent = message;

    toast.classList.remove("hidden");
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.classList.add("hidden"), 300);
    }, 2500);
}
