<?php
    require_once 'bootstrap.php';
    $templateParams["js"] = array("js/api-create-post.js");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Crea un annuncio</title>

        <link rel="stylesheet" type="text/css" href="./css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- for special font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BBH+Bartle&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="UTF-8">
    </head>
    
    <body>
        <header class="p-2">
            <h1 class="m-0" style="text-align: center;">CREA ANNUNCIO</h1>
        </header>
        <main>
            <form class="p-3" method="POST" id="postForm">
                <p></p>
                <ul class="list-group row justify-content-center">
                    <li class="mb-3 col-md-6">
                        <label class="form-label" for="titolo">Titolo:</label>
                        <input class="form-control" type="text" id="titolo" name="titolo" required/>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="descrizione">Descrizione:</label>
                        <textarea class="form-control" id="descrizione" name="descrizione" rows="5" placeholder="scrivi qui la descrizione del tuo annuncio" required></textarea>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="data">Data:</label>
                        <input class="form-control" type="date" id="data" name="data" required/>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="orario">Ora:</label>
                        <input class="form-control" type="time" id="orario" name="orario" required/>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="nPartecipanti">Posti disponibili:</label>
                        <input class="form-control" type="number" id="nPartecipanti" name="nPartecipanti"/>
                    </li>
                    <li class="mb-3">
                        <fieldset>
                            <legend>Luogo dell'evento:</legend>
                        
                            <div class="row g-3 mb-2">
                                <div class="col">
                                    <input type="text" class="form-control" id="via" name="via" placeholder="Via San Migniato">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="civico" name="civico" placeholder="Civico">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="text" class="form-control" id="citta" name="citta" placeholder="Città">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="comune" name="comune" placeholder="Comune">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia">
                                </div>
                            </div>
                        </fieldset>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="categoria">Categoria:</label>
                        <select class="form-select" name="categoria" id="categoria">
                            <option value="">-------</option>
                            <option value="sport">Sport</option>
                            <option value="studio">Studio</option>
                            <option value="festa">Festa</option>
                        </select>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="foto">Aggiungi una foto:</label>
                        <input class="form-control" type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png">
                    </li>
                </ul>
                <!--<footer class="container-fluid">-->
                    <div class="row justify-content-center p-3">
                        <button class="col-4 button border border-black rounded-3" type="submit">POSTA</button>
                    </div>
                <!-- </footer> -->
            </form>
        </main>
        <?php
        if(isset($templateParams["js"])):
            foreach($templateParams["js"] as $script): ?>
        <script src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
        ?>
    </body>
</html>