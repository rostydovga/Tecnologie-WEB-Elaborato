<?php

    require_once("bootstrap.php");

    //se carta ok e carrello non vuoto -> ordine ok
    if(isset($_POST["numerocarta"]) && isset($_POST["scadenza"]) && isset($_POST["cvv"]) && isset($_POST["proprietario"]) && !$carrello->isEmpty()) {
        //concludere ordine nel db
        $dbh->completeOrder($_SESSION["IdUtente"], $_SESSION["Ordine"]);
        //sottrarre le quantità
        $prodotticarrello = $carrello->getProducts($_SESSION["IdUtente"], $_SESSION["Ordine"]);
        foreach($prodotticarrello as $prodotto) {
            $resto = $prodotto["QuantMax"]-$prodotto["QuantNelCarrello"];
            $dbh->subtractQuantity($prodotto["IdProdotto"], $resto);
        }
        //creare un nuovo carrello
        $_SESSION["Ordine"] += 1;
        $dbh->createCartForUser($_SESSION["IdUtente"], $_SESSION["Ordine"]);

        //va bene?
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login.php";  //prob. login-home

    } else {
        $templateParams["titolo"] = "C&D Confirmation";
        $templateParams["nome"] = "order.php";
        $templateParams["navbarFixed"] = "";
        $templateParams["prodotticarrello"] = $carrello->getProducts($_SESSION["IdUtente"], $_SESSION["Ordine"]);
        $templateParams["totale"] = $carrello->getSubtotal($_SESSION["IdUtente"], $_SESSION["Ordine"]);
    }

    $templateParams["cartUsability"] = "disabled";

    require_once("template/base.php");

?>