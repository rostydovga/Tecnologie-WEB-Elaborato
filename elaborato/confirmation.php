<?php

    require_once("bootstrap.php");

    $templateParams["cartUsability"] = "disabled";

    //se carta ok e carrello non vuoto -> ordine ok
    if(isset($_POST["numerocarta"]) && isset($_POST["scadenza"]) && isset($_POST["cvv"]) && isset($_POST["proprietario"]) && !$carrello->isEmpty()) {
        //concludere ordine nel db
        $dbh->completeOrder($_SESSION["IdUtente"], $_SESSION["Ordine"]);

        $centronotifiche->addMessage($_SESSION["IdUtente"], "order n.".$_SESSION["Ordine"]." carried out successfully.");

        //sottrarre le quantità
        $prodotticarrello = $carrello->getProducts($_SESSION["IdUtente"], $_SESSION["Ordine"]);
        foreach($prodotticarrello as $prodotto) {
            $resto = $prodotto["QuantMax"]-$prodotto["QuantNelCarrello"];
            $dbh->subtractQuantity($prodotto["IdProdotto"], $resto);
            //controllo quantita per notifica venditore
            if($resto < 10 && $resto > 0) {
                $idadmin = $dbh->getAdminId()[0]["IdUtente"];
                $centronotifiche->addMessage($idadmin, "stocks of the product (name: ".$prodotto["Nome"].", id: ".$prodotto["IdProdotto"].") are running out (qty: ".$resto.").");
            } elseif($resto == 0) {
                $idadmin = $dbh->getAdminId()[0]["IdUtente"];
                $centronotifiche->addMessage($idadmin, "stocks of the product (name: ".$prodotto["Nome"].", id: ".$prodotto["IdProdotto"].") are finished.");
            }
        }

        //creare un nuovo carrello
        $_SESSION["Ordine"] += 1;
        $dbh->createCartForUser($_SESSION["IdUtente"], $_SESSION["Ordine"]);

        $templateParams["storico"] = $dbh->getOrders($_SESSION["IdUtente"]);
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-home.php";
        $templateParams["isAdmin"] = 0;
        $templateParams["cartUsability"] = "";

    } else {
        $templateParams["titolo"] = "C&D Confirmation";
        $templateParams["nome"] = "order.php";
        $templateParams["prodotticarrello"] = $carrello->getProducts($_SESSION["IdUtente"], $_SESSION["Ordine"]);
        $templateParams["totale"] = $carrello->getSubtotal($_SESSION["IdUtente"], $_SESSION["Ordine"]);
    
    }

    require_once("template/base.php");

?>