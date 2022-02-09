<?php

    require_once("bootstrap.php");

    //includere Bootstrap

    //Logica
    $templateParams["titolo"] = "C&D Home";
    $templateParams["prodotticasuali"] = $dbh->getRandomProducts(); 

    $templateParams["prodotti"] = $dbh->getProducts();

    //Presentazione
    require_once("template/base.php");
?>