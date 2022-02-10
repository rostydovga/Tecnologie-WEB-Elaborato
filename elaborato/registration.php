<?php
    require_once("bootstrap.php");

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])){
        //controllo che l'email non sia gia stata usata
        if(count($dbh->checkEmailExisting($_POST["email"]))){
            $templateParams["emailEsistente"] = "You already have an account, want to login?";
            $templateParams["modal-title"] = "An error has occurred";
            $templateParams["modal-text"] = "Your email already has been used, click Confirm to go to the login page, or close to stay here";
            $templateParams["on-close"] = "registration.php";
            $templateParams["on-ok"] = "login.php";    
        }else{
            //Registro l'utente salvandolo nel db
            $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["password"]);
            $templateParams["modal-title"] = "You are correctly registered";
            $templateParams["modal-text"] = "Click Confirm to jump to the login page, or Close to go to the home page";
            $templateParams["on-close"] = "index.php";
            $templateParams["on-ok"] = "login.php";    
        }
        
    }

    //$templateParams["utente_registrato"] = 1;
    $templateParams["titolo"] = "C&D Registration";
    $templateParams["nome"] = "registration-form.php";
    $templateParams["navbarFixed"] = "";


    
    require_once("template/base.php");

?>