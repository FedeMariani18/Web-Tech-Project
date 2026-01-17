function createPost(posts){
    let result = "";

    for(let i=0; i < posts.length; i++){
        let postHTML = `
        <a href="post.php?id=${posts[i]['id']}" class="text-decoration-none text-dark">
        <div class="post card mb-3">
            <div class="row g-0 align-items-center">
                <div class="col-4">
                    <img src="${posts[i]['foto']}" 
                         class="img-fluid rounded-start"
                         alt="immagine annuncio">
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <h6 class="card-title mb-1">${posts[i]['titolo']}</h6>
                        <p class="card-text small text-muted mb-0">
                            ${posts[i]['descrizione']}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </a>
        `;
        result += postHTML;
    }
    return result;
}

async function getPostData() {
    const url = 'api-like.php';
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
        const profile = document.getElementById("profile");
        const profileImg = document.getElementById("profileImg");
        if (json['utenteLoggato']) {
            profile.href = "my-profile.php";
            profileImg.src = json['fotoProfilo'];
        }
        const posts = createPost(json['likes']);
        const main = document.querySelector("main");
        main.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();