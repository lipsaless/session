<?php 
    session_start();

    if (!isset($_SESSION['email'])) {
        header('Location: admin.php');
    }
?>

Parabéns! você conseguiu terminar o trabalho.