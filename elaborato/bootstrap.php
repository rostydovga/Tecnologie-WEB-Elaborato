<?php
    //variabili di connessione al db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cddb";
    $port = 3306;

    //includere file per connessione DB
    require_once("db/database.php");
    //istanziare helper per DB
    $dbh = new DatabaseHelper($servername, $username, $password, $dbname, $port);


    //inserimento di costanti
    define("UPLOAD_DIR","./upload/products/");

?>