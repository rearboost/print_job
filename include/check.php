<?php
    session_start();
    $email= $_SESSION['email'];
    if(!isset($_SESSION['email'])){
    header('Location: index');
    }
?>
