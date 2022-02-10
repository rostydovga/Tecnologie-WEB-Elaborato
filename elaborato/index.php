<?php

    require_once("bootstrap.php");

    //Logica
    $templateParams["titolo"] = "C&D Home";
    $templateParams["nome"] = "home.php";
    $templateParams["navbarFixed"] = "fixed-top";
    $templateParams["prodotticasuali"] = $dbh->getRandomProducts(); 

    $templateParams["prodotti"] = $dbh->getProducts();

    //Presentazione
    require_once("template/base.php");
?>