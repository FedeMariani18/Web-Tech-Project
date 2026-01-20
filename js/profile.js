function createProfile(user){
    const result = `
    <div class="row justify-content-center m-0">

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

        <div>
            <h2 class="fs-2 fw-bold" >Post attivi:</h2>
            ${getActivePost(user)}
            
        </div>

    </div>
    `;
    return result;
}

function getActivePost(user) {
    let result = "";

    for(let i=0; i < user['postAttivi'].length; i++){
        let postHTML = `
        <div class="col-10 col-lg-4 p-3 p-md-4">
                <a class="link-underline link-underline-opacity-0 text-reset" href="post.php?id=${user['postAttivi'][i]["id"]}">
                    <article class="row rounded-5 border border-black border-1">
                        <img class="col-5 img-fluid rounded-start-5 p-0" src="${user['postAttivi'][i]["foto"]}" alt="immagine del annuncio">
                        <div class="col-7">
                            <div class="">
                                <h5 class="card-title">${user['postAttivi'][i]["titolo"]}</h5>
                                <p class="card-text">${user['postAttivi'][i]["descrizione"]}</p>
                                <p class="card-text"><small class="text-body-secondary">#${user['postAttivi'][i]["nome_categoria"]}</small></p>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
        `;
        result += postHTML;
    }
    return result;
}


//#region Main
async function getUserData() {
    const url = 'api-profile.php?id=' + userId;
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
        
        //Hidden button if the user is not logged in
        const profile = document.getElementById("my-profile");
        const deleteBtn = document.getElementById("deleteBtn");

        if (json['utenteLoggato']) {
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
            if(json['visitorIsAdmin']){
                deleteBtn.style.display = "block";
            }
        } else {
            const like = document.getElementById("like");
            const notification = document.getElementById("notification");
            like.style.display = "none";
            notification.style.display = "none";
            profile.href = "login.php";
            deleteBtn.style.display = "none";
        }

        //Populate user data
        document.getElementById("profileImg").src = json['foto'];
        document.getElementById("username").innerText = json['username'];
        
        const infoProfile = createProfile(json);
        document.querySelector("main").innerHTML += infoProfile;
    } catch (error) {
        console.log(error.message);
    }
}
//#endregion

//#region Delete profile photo

async function deleteProfilePhoto(userId) {
    const url = 'api-delete-profile-photo.php?id=' + userId;
    try {
        const response = await fetch(url);

        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();

        if(json['deletesuccess']) {
            //Reload the page to reflect changes
            window.location.reload();
        } else {
            console.log("Error deleting profile photo: " + json['error']);
        }

    } catch (error) {
        console.log(error.message);
    }
}

document.addEventListener("DOMContentLoaded", () => {

    const confirmBtn = document.getElementById("confirmDeleteBtn");

    confirmBtn.addEventListener("click", () => {

        deleteProfilePhoto(userId);
    });
});
//#endregion

const userId = new URLSearchParams(window.location.search).get("id");

getUserData();