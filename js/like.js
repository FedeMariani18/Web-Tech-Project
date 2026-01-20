function createPost(posts){
    let result = "";

    if (posts.length == 0) {
        return `Non hai nessun annuncio preferito.`;
    }
    for(let i=0; i < posts.length; i++){
        let data = new Date(posts[i]["data_ora"]);
        let postHTML = `
        <div class="col-10 col-lg-3 p-3 p-md-4">
            <a class="flex-container link-underline link-underline-opacity-0 text-reset" href="post.php?id=${posts[i]["id"]}">
                <article class="row rounded-5 border border-black border-1 ">
                    <img class="img-fluid p-0" src="${posts[i]["foto"]}" alt="immagine del annuncio">
                    <div class="">
                        <h4 class="card-title m-0">${posts[i]["titolo"]}</h4>
                        <p class="card-text m-0 text-align-start">${data.toLocaleString()}</p>
                        <p class="card-text text-secondary m-0 text-align-start">#${posts[i]["nome_categoria"]}</p>
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
        const main = document.getElementById("posts-container");
        main.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();