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
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- for special font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BBH+Bartle&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header class="container-fluid pt-2 pb-3">
            <div class="row align-items-center">
                <h1 class="col-2 col-md-6"><a href="index.php" style="color:#DA627D; text-decoration:none;">UNINET</a></h1>
                <div class="col-10 col-md-6">
                    <nav class="d-flex justify-content-end gap-2 index-nav-small">
                        <a href="like-page.php" id="like" aria-label="Icona dei preferiti" class="nav-item-box hidden-element me-4">
                            <span id="likeIcon" class="bi bi-heart text-black" aria-hidden="true"></span>
                        </a>
                        <a href="notification-page.php" id="notification" aria-label="Icona delle notifiche" class="nav-item-box hidden-element me-4">
                            <span id="notificationIcon" class="bi bi-bell text-black" aria-hidden="true"></span>
                        </a>
                        <a href="login.php" id="profile" aria-label="Profilo utente" class="nav-item-box me-3">
                            <span id="profileIcon" class="bi bi-person-circle text-black" aria-hidden="true"></span>
                        </a>
                    </nav>
                </div>
            </div>
            
            <form class="container-fluid mt-4" role="search" id="searchForm">
                <div class="row justify-content-center">
                    <label for="search" class="visually-hidden">Search</label>
                    <input class="col-6 rounded-5" id="search" type="search" placeholder="Search" aria-label="Search">
                    <div class="col-2">
                        <div class="row justify-content-center">
                            <button class="col-10 rounded-5" type="submit" aria-label="Pulsante di ricerca">
                                <span id="searchIcon" class="bi bi-search text-black"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </header>

        <nav>
            <button class="position-fixed bottom-0 start-50 mb-4 rounded-circle hidden-element" type="button" id="createPost">
                <a href="create-post.php" id="createPostLink" aria-label="Crea un nuovo post">
                    <span class="bi bi-plus-lg text-black fs-1"></span>
                </a>
            </button>
        </nav>

        <!-- MAIN -->
        <main class="container-fluid">
            <p class="mt-3 mb-0">Cerca l'avventura giusta per te</p>
            <strong><label class="m-0 fs-2" id='userTitle'></label></strong>
            <div class="row justify-content-center m-0" id="users-container">
            </div>
            <strong><label class="m-0 fs-2" id='postTitle'></label></strong>
            <div class="row justify-content-center m-0" id="posts-container">
                <!-- il metodo getPostData() in index.js prende il div con id posts-container e ci aggiunge dentro i post. -->
            </div>
        </main>

        <nav>
            <a href="create-post.php" id="createPostLink" aria-label="Crea un nuovo post" class="floating-btn hidden-element">
                <span class="bi bi-plus-circle-fill text-black fs-1"></span>
            </a>
        </nav>

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