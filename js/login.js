const main = document.querySelector("main");
getLoginData();  

async function getLoginData() {
    const url = 'api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);
        if(json["logineseguito"]){
            goToUserProfile();
        }
        else{
            visualizzaLoginForm();
        }


    } catch (error) {
        console.log(error.message);
    }
}

function visualizzaLoginForm() {
    // Utente NON loggato
    let form = generaLoginForm();
    main.innerHTML = form;
    // Gestisco tentativo di login
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#username").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });
}

async function login(username, password) {
    const url = 'api-login.php';
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    try {

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if(json["logineseguito"]){
            goToUserProfile();
        }
        else{
            //visualizza errore login
            document.querySelector("form > p").innerText = json["errorelogin"];
        }


    } catch (error) {
        console.log(error.message);
    }
}

function generaLoginForm(loginerror = null) {
    let form = `
    <form class="p-3" action="#" method="POST" enctype="">
        <ul class="list-group">
            <li class="mb-3">
                <label class="form-label" for="mail">Mail:</label>
                <input class="form-control" type="text" id="username" name="username" value="username" placeholder="Username"/>
            </li>
            <li class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" value="password" placeholder="Password"/>
            </li>
            <li class="mb-3 mt-3">
                <div class="row justify-content-center">
                    <input class="col-8 btn btn-lg important-button border border-black rounded-3" type="submit" name="submit" value="Login" />    
                </div>
            </li>
            <li class="mb-3">
                <div class="row justify-content-center">
                    <a class="col-8 btn btn-lg border border-black rounded-3" href="create_an_account.html">Non hai un account?</a>
                </div>
            </li>
        </ul>
    </form>`;
    return form;
}


function goToUserProfile(){
    //TODO: go to user Profile
}
