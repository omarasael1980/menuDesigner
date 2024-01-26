<?php
 
 if(!isset($_SESSION)){
    session_start();
}

unset($_SESSION['user']);
unset($_SESSION['token']);
session_destroy();
header("location: ../");
?>