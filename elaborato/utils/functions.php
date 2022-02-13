<?php 
    function isActive($pagename){
        if(basename($_SERVER["PHP_SELF"])==$pagename){
            echo " class='active' ";
        }
    }

    /*Ritorna true se l'utente e loggato*/
    function isUserLoggedIn(){
        return isset($_SESSION["IdUtente"]);
    }

    function registerLoggedUser($user){
        $_SESSION["IdUtente"] = $user["IdUtente"];
        $_SESSION["Nome"] = $user["Nome"];
        $_SESSION["Cognome"] = $user["Cognome"];
    }

    function logOutUser(){
        $_SESSION["IdUtente"] = NULL;
        $_SESSION["Nome"] = NULL;
        $_SESSION["Cognome"] = null;
        $_SESSION["Ordine"] = NULL;
        session_destroy();
    }

?>