
<?php
session_start();
session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");


    ?>