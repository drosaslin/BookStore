<?php
    session_start();
    if($_SESSION['access']!=1 || $_SESSION['class']!=3) header('Location: login.php');

?>
