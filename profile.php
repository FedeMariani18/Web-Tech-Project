<?php
require_once 'bootstrap.php';
$templateParams["js"] = array("js/profile.js");
?>

<!DOCTYPE html>
<html lang="it" class="m-0">
<head>
    <title>Profile</title>

    <link rel="stylesheet" type="text/css" href="./css/style.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
        
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
        <div class="col-10 col-md-6">
            <nav class="d-flex justify-content-end gap-2">
                <a href="like-page.php" id="like"><img src="resources/heart.png" alt="icon del cuore"/></a>
                <a href="notification-page.php" id="notification"><img src="resources/notification.png" alt="icona delle notifiche"/></a>
                <a href="" id="my-profile"><img src="resources/user_icon.png" alt="icona dell'utente" id="my-profileImg" class="rounded-circle border"/></a>
            </nav>
        </div>
    </div>


    <div class="d-flex justify-content-center mt-3">

        <figure class="position-relative m-0 text-center">

            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 translate-middle rounded-circle p-2 align-items-center justify-content-center" 
                    id="deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#confirmDeleteModal">
                <i class="bi bi-x-lg"></i>
            </button>


            <img src="resources/user_icon.png"
                id="profileImg"
                class="rounded-circle border"
                width="120">

            <figcaption id="username" class="mt-2">Username</figcaption>

        </figure>

    </div>



</header>

<main class="container-fluid">
    
</main>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Elimina foto profilo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Sei sicuro di voler eliminare la foto profilo?  
        Questa azione non può essere annullata.
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Elimina</button>
      </div>

    </div>
  </div>
</div>
<?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
            ?><script src="<?php echo $script; ?>"></script><?php
        endforeach;
    endif;
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
