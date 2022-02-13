<?php

    require_once("bootstrap.php");
    
    if(isset($_POST["aggiungiprodotto"])) {
        $dbh->addProduct($_POST["nome"], $_POST["prezzo"], $_POST["desc"], $_POST["quantita"], $_POST["ml"], $_POST["gender"], $_POST["imm"], $_POST["cat"]);
        
        $centronotifiche->addMessage($_SESSION["IdUtente"], "product (".$_POST["nome"].") added successfully.");
    }
    
    if(isset($_POST["modificaprodotto"])) {
        $dbh->modifyProduct($_GET["id"], $_POST["nome"], $_POST["cat"], $_POST["prezzo"], $_POST["quantita"], $_POST["ml"], $_POST["desc"], $_POST["gender"], $_POST["imm"]);
        
        $centronotifiche->addMessage($_SESSION["IdUtente"], "product (name: ".$_POST["nome"].", id: ".$_GET["id"].") modified successfully.");
    }

    $templateParams["prodotti"] = $dbh->getProducts();
    $templateParams["titolo"] = "C&D Fragrances";
    $templateParams["nome"] = "fragrances-list.php";
    $templateParams["categorie"] = $dbh->getCategories();


    require_once("template/base.php");

?>