function createNotifications(notifications){
    let result = "";

    if (notifications.length == 0) {
        return `Non hai nessuna notifica.`;
    }
    for(let i=0; i < notifications.length; i++){
        data = getNotificationData(notifications[i]);
        let notificationHTML = `
            <div class="notification card mb-3 shadow-sm">
                <div class="card-body d-flex align-items-center py-2">
                    <img src="resources/${data['image']}.png" alt="like" class="me-3" width="40" height="40">
                    <div class="flex-grow-1">
                        <p class="mb-1"><strong>${data['mittente']}</strong>${data['testo']}<em>"${data['titoloPost']}"</em></p>
                    </div>
                </div>
            </div>
        `;
        result += notificationHTML;
    }
    return result;
}

function getNotificationData(notification) {
    let data = {};
    data['mittente'] = notification['mittente_username'];
    data['titoloPost'] = notification['titoloPost'];
    switch (notification['nomeTipologia']) {
        case "NUOVO_LIKE_A_POST":
            data['image'] = "like";
            data['testo'] = " ha messo like al tuo post ";
            break;
        case "NUOVA_ISCRIZIONE_A_POST":
            data['image'] = "partecipation";
            data['testo'] = " partecipa al tuo post ";
            break;
        case "NUOVO_COMMENTO_A_POST":
            data['image'] = "comment";
            data['testo'] = " ha scritto un nuovo commento sotto al tuo post ";
            break;
        default:
            break;
    }
    return data;
}

async function getPostData() {
    const url = 'api-notification.php';
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
        const notfications = createNotifications(json['notifications']);
        const main = document.querySelector("main");
        main.innerHTML += notfications;
    } catch (error) {
        console.log(error.message);
    }
}

getPostData();