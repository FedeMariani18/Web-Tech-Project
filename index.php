<?php
//per adesso invece di fare index.php che prende un base.php contente l'html ho lasciato direttamente tutto in index.php
//se altre pagine hanno una struttura simile a index e cambia solo il main allora possiamo fare un base.php generale che usano tutti (come nell'ultimo lab)
require_once 'bootstrap.php';
$templateParams["js"] = array("js/index.js");
?>

<!DOCTYPE html>
<html lang="it" class="m-0">
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- for special font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BBH+Bartle&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <header class="container-fluid pb-3">
            <div class="row align-items-center">
                <h1 class="col-2 col-md-6"><a href="index.php" style="color:#DA627D; text-decoration:none;">UNINET</a></h1>
                <div class="col-10 col-md-6">
                    <nav class="d-flex justify-content-end gap-2 index-nav-small">
                        <a href="like-page.php" id="like" aria-label="Icona dei preferiti" class="nav-item-box">
                            <i id="like" class="bi bi-heart text-black" aria-hidden="true"></i>
                        </a>
                        <a href="notification-page.php" id="notification" aria-label="Icona delle notifiche" class="nav-item-box">
                            <i id="notification" class="bi bi-bell text-black" aria-hidden="true"></i>
                        </a>
                        <a href="" id="profile" aria-label="Profilo utente" class="nav-item-box">
                            <i id="profileIcon" class="bi bi-person-circle text-black" aria-hidden="true"></i>
                        </a>
                    </nav>
                </div>
            </div>
            
            <form class="container-fluid" role="search" id="searchForm">
                <div class="row justify-content-center">
                    <input class="col-6 rounded-5" id="search" type="search" placeholder="Search" aria-label="Search"/>
                    <div class="col-2">
                        <div class="row justify-content-center">
                            <button class="col-10 rounded-5" type="submit"><img src="resources/magnifying_glass_icon.png" alt="icona della lente d'ingrandimento"></button>
                        </div>
                    </div>
                </div>
            </form>
            
        </header>

        <!-- MAIN -->
        <main class="container-fluid">
            <p class="mt-3">Cerca l'avventura giusta per te</p>
            <p class="m-0" id='userTitle'></p>
            <div class="row justify-content-center m-0" id="users-container">
            </div>
            <p class="m-0" id='postTitle'></p>
            <div class="row justify-content-center m-0" id="posts-container">
                <!-- il metodo getPostData() in index.js prende il div con id posts-container e ci aggiunge dentro i post. -->
            </div>
        </main>

        <nav>
            <button class="position-fixed bottom-0 start-50 mb-4 rounded-circle" type="button" id="createPost">
                <a href="create-post.php"><img class=""  src="resources/sum_icon.webp" alt="icon del più"/></a>
            </button>
        </nav>
        
        <!-- TOAST DI ERRORE -->
        <div id="toast-error" class="toast-error hidden"></div>

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