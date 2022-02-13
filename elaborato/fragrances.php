<?php

    require_once("bootstrap.php");
    
    if(isset($_POST["aggiungiprodotto"])) {
        $dbh->addProduct($_POST["nome"], $_POST["prezzo"], $_POST["desc"], $_POST["quantita"], $_POST["ml"], $_POST["gender"], $_POST["imm"], $_POST["cat"]);
    }
    
    if(isset($_POST["modificaprodotto"])) {
        $dbh->modifyProduct($_GET["id"], $_POST["nome"], $_POST["cat"], $_POST["prezzo"], $_POST["quantita"], $_POST["ml"], $_POST["desc"], $_POST["gender"], $_POST["imm"]);
    }

    if(isset($_POST["ordinamento"])) {
        $templateParams["prodotti"] = $dbh->orderProducts($_POST["ordinamento"]);
    } else {
        $templateParams["prodotti"] = $dbh->getProducts();
    }
    $templateParams["titolo"] = "C&D Fragrances";
    $templateParams["nome"] = "fragrances-list.php";
    $templateParams["categorie"] = $dbh->getCategories();


    require_once("template/base.php");

?>