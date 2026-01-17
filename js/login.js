const main = document.querySelector("main");
getLoginData();
setTimeout(() => document.querySelector('.popup')?.remove(), 4000); //nasconde il pop-up in caso ci sia


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
        <p></p>
        <ul class="list-group">
            <li class="mb-3">
                <label class="form-label" for="mail">Mail:</label>
                <input class="form-control" type="text" id="username" name="username" placeholder="Username"/>
            </li>
            <li class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Password"/>
            </li>
            <li class="mb-3 mt-3">
                <div class="row justify-content-center">
                    <button class="col-8 btn btn-lg important-button border border-black rounded-3" type="submit" id="submit">Login</button>    
                </div>
            </li>
            <li class="mb-3">
                <div class="row justify-content-center">
                    <a class="col-8 btn btn-lg border border-black rounded-3" href="create_account.php">Non hai un account?</a>
                </div>
            </li>
        </ul>
    </form>`;
    return form;
}


function goToUserProfile(){
    window.location.replace("my-profile.php");   //TODO: rimpiazzarlo con la pagina del profilo
}
