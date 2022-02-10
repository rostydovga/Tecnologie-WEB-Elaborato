<?php

    require_once("bootstrap.php");

    //estrarre l'id del prodotto dal URL
    $idProduct = $_GET["id"];
    
    //cercarlo nel DB 
    $templateParams["infoProdotto"] = $dbh->getProductInfo($idProduct);

    $templateParams["titolo"] = "C&D Product";
    $templateParams["nome"] = "presentation-product.php";
    $templateParams["prodotticasuali"] = $dbh->getRandomProducts();
    $templateParams["navbarFixed"] = "";

    //Presentazione
    require_once("template/base.php");

?>