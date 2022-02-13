<?php
    require_once("bootstrap.php");

    if(isset($_POST["action"])){
        logOutUser();
    }
    
    if(isset($_POST["email"]) && isset($_POST["password"])){ //&& isset($_POST["cb1"])
        //Controllo se esiste sul db
        $login_result = $dbh->checkLogin($_POST["email"],$_POST["password"]);

        if(count($login_result)==0){
            //Login Fallito
            $templateParams["erroreLogin"] = "Password or email are wrong";
        }else{
            //Loggo utente
            registerLoggedUser($login_result[0]);
        }
    }

    if(isUserLoggedIn()){

        if(count($dbh->isAdmin($_SESSION["IdUtente"]))){
            $templateParams["isAdmin"] = 1;
        }else{
            $templateParams["isAdmin"] = 0;
        }

        if(!isset($_SESSION["Ordine"])) {  //primo login in assoluto dell'utente (non ha ancora la session ordine)
            $_SESSION["Ordine"] = 1;
            $dbh->createCartForUser($_SESSION["IdUtente"], $_SESSION["Ordine"]); //si crea carrello nel db
        }

        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-home.php";

    }else{
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-form.php";
    }
    
    //Presentazione
    require_once("template/base.php");
?>