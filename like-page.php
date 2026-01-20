<?php
require_once 'bootstrap.php';
$templateParams["js"] = array("js/like.js");
?>

<!DOCTYPE html>
<html lang="it" class="m-0">
    <head>
        <title>Profile</title>
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
        <header class="container-fluid">
            <div class="row align-items-center">
                <h1 class="col-2 col-md-6"><a href="index.php" style="color:#DA627D; text-decoration:none;">UNINET</a></h1>
            </div>
            <div class="container-fluid">
                <nav class="d-flex justify-content-center gap-2 profile-icon-nav align-items-center">
                    <a href="notification-page.php" id="notification" aria-label="Icona delle notifiche" class="nav-item-box">
                        <i id="notification" class="bi bi-bell text-black" aria-hidden="true"></i>
                    </a>
                    <a href="like-page.php" id="like" aria-label="Icona dei preferiti" class="nav-item-box">
                        <i id="like" class="bi bi-heart text-black" aria-hidden="true"></i>
                    </a>
                    <a href="" id="profile" aria-label="Icona profilo" class="nav-item-box">
                        <img src="" alt="icona dell'utente" id="profileImg" class="rounded-circle border profile-hover"/>
                    </a>
                </nav>
            </div>
            <div class="row justify-content-center">
                <h1 class="text-center" id="username" >Username</h1>
            </div>
        </header>

        <main class="container-fluid">
            <h5 class="mb-3">Annunci preferiti:</h5>
            <div class="row justify-content-center m-0" id="posts-container">
                <!-- il metodo getPostData() in index.js prende il div con id posts-container e ci aggiunge dentro i post. -->
            </div>
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