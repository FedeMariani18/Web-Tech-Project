const radio = document.querySelectorAll("input[type='radio']");
radio.forEach(radio => {
    radio.addEventListener("change", function(event) {
        const container = document.querySelector("main");
        container.innerHTML = "";
        
        if(event.target.id === "utenti"){
            showUsersList();
        } else {
            showPostsList();
        }
    });
});
showUsersList();

async function showUsersList(){
    
    createUserRow(getUserData());
}

async function showPostsList(){
    createPostRow(getPostData());
}

async function getUserData() {
    const url = 'api-users.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const users = createUserRow(json);
        const container = document.querySelector("main");
        container.innerHTML += users;
    } catch (error) {
        console.log(error.message);
    }
}

function createUserRow(users){
    let result = "";

    result += `
    <table class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">nome</th>
                    <th scope="col">cognome</th>
                    <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>`;

    for(let i=0; i < users.length; i++){
        let postHTML = `
        <tr>
            <th scope="row">${i}</th>
            <td>${users[i]["username"]}</td>
            <td>${users[i]["nome"]}</td>
            <td>${users[i]["cognome"]}</td>
            <td>banna, visita</td>
        </tr>
        `;
        result += postHTML;
    }

    result += `
        </tbody>
    </table>`;
    return result;
}

async function getPostData() {
    const url = 'api-posts.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const posts = createPostRow(json);
        const container = document.querySelector("main");
        container.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

function createPostRow(posts){
    let result = "";

    result += `
    <table class="table table-secondary table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                        <th scope="col">titolo</th>
                        <th scope="col">data</th>
                        <th scope="col">organizzatore</th>
                        <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>`;

    for(let i=0; i < posts.length; i++){
        let postHTML = `
        <tr>
            <th scope="row">1</th>
            <td>${posts[i]["titolo"]}</td>
            <td>${posts[i]["data"]}</td>
            <td>${posts[i]["id_creatore"]}</td>
            <td>banna, visita</td>
        </tr>
        `;
        result += postHTML;
    }

    result += `
        </tbody>
    </table>`;
    return result;
}