<?php
require_once 'bootstrap.php';
$templateParams["js"] = array("js/my-profile.js");
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
                <a href="index.php" id="home" aria-label="Icona Home" class="nav-item-box">
                    <span class="bi bi-house text-black" aria-hidden="true"></span>
                </a>
                <a href="edit-profile.php" id="editProfile" aria-label="Icona modifica" class="nav-item-box">
                    <span class="bi bi-pencil-square text-black" aria-hidden="true"></span>
                </a>
                <a href="" id="logout" onclick="logout();" aria-label="Icona logout" class="nav-item-box">
                    <span class="bi bi-box-arrow-right text-black" aria-hidden="true"></span>
                </a>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <nav class="d-flex justify-content-center gap-2 profile-icon-nav align-items-center">
            <a href="like-page.php" id="like" aria-label="Icona dei preferiti" class="nav-item-box">
                <span id="likeIcon" class="bi bi-heart text-black" aria-hidden="true"></span>
            </a>
            <a href="" id="profile" class="nav-item-box">
                <img src="" alt="icona dell'utente" id="profileImg" class="rounded-circle border profile-hover"/>
            </a>
            <a href="notification-page.php" id="notification" aria-label="Icona delle notifiche" class="nav-item-box">
                <span id="notificationIcon" class="bi bi-bell text-black" aria-hidden="true"></span>
            </a>
        </nav>
    </div>

    <div class="row justify-content-center">
        <h1 class="text-center" id="username" >Username</h1>
    </div>

</header>

<main class="container-fluid">
    <div class="row justify-content-center m-0" id="posts-container">

    </div>
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
