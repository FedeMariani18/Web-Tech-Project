<?php
require_once 'bootstrap.php';

$templateParams["js"] = array("js/create-account.js");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Crea account</title>

        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- for special font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BBH+Bartle&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    
    <body>
        <header class="p-2">
            <h1 class="m-0" style="text-align: center;">CREA ACCOUNT</h1>
        </header>
        <main>
            <form class="p-3" method="POST">
                <p></p>
                <ul class="list-group row justify-content-center">
                    <li class="mb-3">
                        <label class="form-label" for="foto">Aggiungi una foto:</label>
                        <input class="form-control" type="file" id="foto" accept=".jpg, .jpeg, .png">
                    </li>
                    <li class="mb-3 col-md-6">
                        <div class="row g-3 mb-2">
                            <label class="col form-label" for="nome">Nome:</label>
                            <label class="col form-label" for="cognome">Cognome:</label>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col">
                                <input type="text" class="col form-control" id="nome" name="nome" placeholder="Nome" required>
                            </div>
                            <div class="col">
                                <input type="text" class="col form-control" id="cognome" name="cognome" placeholder="Cognome" required>
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="row g-3 mb-2">
                            <label class="col form-label" for="username">Username:</label>
                            <label class="col form-label" for="telefono">Numero di telefono:</label>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="mail">Mail:</label>
                        <input class="form-control" type="email" id="mail" name="mail" placeholder="mail@gmail.com" required>
                    </li>
                    <li class="mb-3">
                        <label class="form-label" for="password">Password:</label>
                        <button class="btn btn-outline-secondary mb-1" type="button" id="togglePassword">
                            <span id="eyeIcon">Mostra</span>
                        </button>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                    </li>
                    <li class="mb-3">
                        <div class="row justify-content-center">
                            <button class="col-8 btn btn-lg important-button border border-black rounded-3" type="submit" id="submit">Crea il tuo account</button>    
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="row justify-content-center">
                            <a class="col-8 btn btn-lg border border-black rounded-3" href="login.php">Hai già un account?</a>
                        </div>
                    </li>
                </ul>
            </form>
        </main>

        <?php
            if(isset($templateParams["js"])):
                foreach($templateParams["js"] as $script):
                    ?><script src="<?php echo $script; ?>"></script><?php
                endforeach;
            endif;
        ?>
    </body>
</html>