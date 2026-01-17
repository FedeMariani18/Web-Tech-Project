console.log("Script api-create-post.js caricato");

async function createPost(titolo, descrizione, dataOra, nPartecipanti, indirizzo, citta, comune, provincia, categoria, foto) {
    const url = 'api-create-post.php';
    try {
        const formData = new FormData();
        formData.append("titolo", titolo);
        formData.append("descrizione", descrizione);
        formData.append("dataOra", dataOra);
        formData.append("nPartecipanti", nPartecipanti);
        formData.append("indirizzo", indirizzo);
        formData.append("citta", citta);
        formData.append("comune", comune);
        formData.append("provincia", provincia);
        formData.append("categoria", categoria);
        formData.append("foto", foto);

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        if(json["postcreated"]){
            goToPost(json["idPost"]);
        }
        else{
            document.querySelector("form > p").innerText = json["errorcreation"];
        }

    } catch (error) {
        console.log(error.message);
    }
}

function goToPost(id) {
    window.location.href = "post.php?id=" + id;
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#postForm");
    if(form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const titolo = document.querySelector("#titolo").value;
            const descrizione = document.querySelector("#descrizione").value;
            const data = document.querySelector("#data").value;
            const orario = document.querySelector("#orario").value;
            const nPartecipanti = document.querySelector("#nPartecipanti").value;
            const via = document.querySelector("#via").value;
            const civico = document.querySelector("#civico").value;
            const citta = document.querySelector("#citta").value;
            const comune = document.querySelector("#comune").value;
            const provincia = document.querySelector("#provincia").value;
            const categoria = document.querySelector("#categoria").value;
            const foto = document.querySelector("#foto").files[0];

            const dataOra = data && orario ? `${data} ${orario}:00` : '';
            const indirizzo = civico ? `${via} ${civico}`.trim() : via;

            createPost(titolo, descrizione, dataOra, nPartecipanti, indirizzo, citta, comune, provincia, categoria, foto);
        });
    }
});