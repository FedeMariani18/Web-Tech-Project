function createPost(posts){
    let result = "";

    for(let i=0; i < posts.length; i++){
        let postHTML = `
        <div class="col-10 col-lg-4 p-3 p-md-4">
                <a class="link-underline link-underline-opacity-0 text-reset" href="post.php?id=${posts[i]["id"]}">
                    <article class="row rounded-5 border border-black border-1">
                        <img class="col-5 img-fluid rounded-start-5 p-0" src="${posts[i]["foto"]}" alt="immagine del annuncio">
                        <div class="col-7">
                            <div class="">
                                <h5 class="card-title">${posts[i]["titolo"]}</h5>
                                <p class="card-text">${posts[i]["descrizione"]}</p>
                                <p class="card-text"><small class="text-body-secondary">#${posts[i]["nome_categoria"]}</small></p>
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

async function getPostData() {
    const url = 'api-post.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
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
        const posts = createPost(json['post']);
        const container = document.getElementById("posts-container");
        container.innerHTML += posts;
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
            const postsHTML = createPost(json['results']);
            const container = document.getElementById("posts-container");
            container.innerHTML = postsHTML;
        }
        else{
            showErrorToast(json['error']);
        }
    } catch (error) {
        console.log(error.message);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#searchForm");
    if(form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const searchQuery = document.querySelector("#search").value;
            search(searchQuery);
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
