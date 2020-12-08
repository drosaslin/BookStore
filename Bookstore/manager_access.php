<?php
    session_start();
    if($_SESSION['access']!=1 || $_SESSION['class']!=2) header('Location: login.php');
?>
