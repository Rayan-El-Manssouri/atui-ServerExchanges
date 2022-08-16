<?php 
    function est_connecter():bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return !empty($_SESSION['connecte']);
    }
?>