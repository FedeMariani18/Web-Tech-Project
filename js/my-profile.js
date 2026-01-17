function createProfile(user){
    const result = `
    <div class="row justify-content-center m-0">
        <div>
            <h2>Info</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Error, animi fugit! Modi, aspernatur eligendi libero quod eum
                impedit sequi exercitationem possimus ab!
            </p>
        </div>
        <div>
            <h2>Post attivi:</h2>
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

async function getUserData() {
    const url = 'api-profile.php';
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
        const profileImg = document.getElementById("profileImage");
        profileImg.src = json['foto'];
        const username = document.getElementById("username");
        username.innerText = json['username'];
        const profile = createProfile(json);
        const main = document.querySelector("main");
        main.innerHTML += profile;
    } catch (error) {
        console.log(error.message);
    }
}

getUserData();