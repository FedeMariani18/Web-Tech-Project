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
                <div class="col-10 col-md-6">
                    <nav class="d-flex justify-content-end gap-2">
                        <img src="resources/modifying_icon.webp" alt="icon del cuore"/>
                    </nav>
                </div>
            </div>

            <div class="container-fluid">
                <nav class="d-flex justify-content-center gap-2 profile-icon-nav align-items-center">
                    <a href="notification-page.php" id="notification"><img src="resources/notification.png" alt="icona delle notifiche"/></a>
                    <a href="like-page.php" id="like"><img src="resources/heart.png" alt="icon del cuore"/></a>
                    <a href="" id="profile"><img src="resources/user_icon.png" alt="icona dell'utente" id="profileImg"/></a>
                </nav>
            </div>
        </header>

        <main class="container-fluid secondary-subtle py-3">
            <h5 class="mb-3">Annunci preferiti:</h5>
            
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