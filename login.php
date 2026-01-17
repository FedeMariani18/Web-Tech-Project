<?php
require_once 'bootstrap.php';
$templateParams["js"] = array("js/login.js");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Login</title>

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
            <h1 class="m-0" style="text-align: center;">LOGIN</h1>
        </header>
        <?php if (isset($_SESSION["flash_message"])): ?>
            <div class="popup success">
                <?= $_SESSION["flash_message"] ?>
            </div>
        <?php unset($_SESSION["flash_message"]); endif; ?>

        <main>
            <!-- login.js riempirà il main con il form per il login -->
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