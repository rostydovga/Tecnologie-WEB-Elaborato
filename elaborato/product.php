<?php

    require_once("bootstrap.php");

    //estrarre l'id del prodotto dal URL
    $idprodotto = $_GET["id"];

    $templateParams["titolo"] = "C&D Product";
    $templateParams["nome"] = "presentation-product.php";

    if(isset($_POST["aggiungialcarrello"]) && isset($_SESSION["IdUtente"])) {
        $idutente = $_SESSION["IdUtente"];
        $quantita = $_POST["prodQuantity"];
        $idordine = $_SESSION["Ordine"];
        $carrello->addProduct($idprodotto, $idutente, $idordine, $quantita);
    }

    if(isset($_POST["modifyProduct"])){
        $templateParams["titolo"] = "C&D Modify Product";
        $templateParams["header"] = "Modify";
        $templateParams["nome"] = "manage.php";
    }

    if(isset($_POST["deleteproduct"])){
        $templateParams["titolo"] = "C&D Fragrances";
        $templateParams["nome"] = "fragrances-list.php";
        $dbh->deleteProduct($idprodotto);

        $centronotifiche->addMessage($_SESSION["IdUtente"], "product (id: ".$idprodotto.") deleted successfully.");

        $templateParams["prodotti"] = $dbh->getProducts();
    }
    
    $templateParams["infoProdotto"] = $dbh->getProductInfo($idprodotto);
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["prodotticasuali"] = $dbh->getRandomProducts();

    //Presentazione
    require_once("template/base.php");

?>