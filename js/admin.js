const radio = document.querySelector("input[type='radio']");
radio.forEach(radio => {
    radio.addEventListener("change", function(event) {
        // console.log("Valore selezionato: " + event.target.value);
        // sendToServer(event.target.value);
        if(event.target.value === "Utenti"){
            showUsersList();
        } else {
            showPostsList();
        }
    });
});

async function getUserData() {
    const url = 'api-post.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const posts = createPost(json);
        const container = document.getElementById("posts-container");
        container.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
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
        const posts = createPost(json);
        const container = document.getElementById("posts-container");
        container.innerHTML += posts;
    } catch (error) {
        console.log(error.message);
    }
}

async function showUsersList(){
    
}

async function showPostsList(){
    
}