<?php
    session_start();
    //variabili di connessione al db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cddb";
    $port = 3307;

    //includere file per connessione DB e altri
    require_once("db/database.php");
    require_once("utils/functions.php");
    require_once("cart.php");
    require_once("notification-center.php");
    //istanziare helper per DB
    $dbh = new DatabaseHelper($servername, $username, $password, $dbname, $port);
    $carrello = new Carrello($dbh);
    $centronotifiche = new CentroNotifiche($dbh);

    if(isUserLoggedIn()){
        if(count($dbh->isAdmin($_SESSION["IdUtente"]))){
            $templateParams["isAdmin"] = 1;
        }else{
            $templateParams["isAdmin"] = 0;
        }
    }else{
        $templateParams["isAdmin"] = 0;
    }
    $templateParams["cartUsability"] = "";

    //inserimento di costanti
    define("UPLOAD_DIR","./upload/products/");

?>