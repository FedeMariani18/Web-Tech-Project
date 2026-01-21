<?php
    require_once 'bootstrap.php';
    $templateParams["js"] = array("js/admin.js");
?>

<!DOCTYPE html>
<html lang="it" class="m-0">
    <head>
        <title>Admin</title>
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
                    <nav class="d-flex justify-content-end gap-2">
                        <nav class="d-flex justify-content-end gap-2">
                        <a href="like-page.php" id="like" aria-label="Icona dei preferiti" class="nav-item-box">
                            <span id="likeIcon" class="bi bi-heart text-black" aria-hidden="true"></span>
                        </a>
                        <a href="notification-page.php" id="notification" aria-label="Icona delle notifiche" class="nav-item-box">
                            <span id="notificationIcon" class="bi bi-bell text-black" aria-hidden="true"></span>
                        </a>
                        <a href="" id="profile" aria-label="Icona profilo" class="nav-item-box">
                            <img src="" alt="icona dell'utente" id="profileImg" class="rounded-circle border profile-hover"/>
                        </a>
                    </nav>
                    </nav>
                </div>
            </div>
            
            <form class="container-fluid text-center" role="search" id="searchForm2">
                <div class="btn-group mb-2  " role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="utenti" autocomplete="off" checked>
                    <label class="btn btn-outline-secondary" for="utenti">Utenti</label>

                    <input type="radio" class="btn-check" name="btnradio" id="post" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="post">Post</label>
                </div>
                <div class="row justify-content-center">
                    <label for="search" class="visually-hidden">Search</label>
                    <input class="col-6 rounded-5" id="search" type="search" placeholder="Search" aria-label="Search"/>
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

        <!-- MAIN -->
        <main class="container-fluid mt-3">
        
        </main>
            
        <?php
            if(isset($templateParams["js"])):
                foreach($templateParams["js"] as $script): ?>
                    <script src="<?php echo $script; ?>" defer></script><?php
                endforeach;
            endif;
        ?>
    </body>
</html>