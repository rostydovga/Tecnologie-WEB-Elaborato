<?php
    require_once("bootstrap.php");

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
        //l'utente e loggato devo definire un nuovo template
        //se l'utente e il proprietario del negozio, faccio vedere il template inerente a lui
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-home.php";
    }else{
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-form.php";
    }
   
    $templateParams["navbarFixed"] = "";
    

    //Presentazione
    require_once("template/base.php");
?>