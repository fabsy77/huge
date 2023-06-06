
<?php
// Redirect zur angegebenen URL
function redirect($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

// Beispiel: Redirect zur Startseite
redirect('https://projectapc.ddns.net/gr10/application/view/index/index.php');
?>