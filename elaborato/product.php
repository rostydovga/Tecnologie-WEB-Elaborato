<?php

    require_once("bootstrap.php");

    
    //estrarre l'id del prodotto dal URL
    $idProduct = $_GET["id"];
    //se utente non e loggato lo mando alla pagina di login
    /*if(isset($_POST["aggiungialcarrello"]) && !isUserLoggedIn()) {
        $templateParams["titolo"] = "C&D Login";
        $templateParams["nome"] = "login-form.php";
    }else{*/
    $templateParams["titolo"] = "C&D Product";
    $templateParams["nome"] = "presentation-product.php";
        //aggiungo il prodotto nel carrello
    if(isset($_POST["aggiungialcarrello"]) && isset($_SESSION["IdUtente"])){
        $idUtente = $_SESSION["IdUtente"];
        $quantita = $_POST["prodQuantity"];
        
        $carrello->addProduct($idProduct,$idUtente,$quantita);
        
    }
    //}

    


    
    //cercarlo nel DB 
    $templateParams["infoProdotto"] = $dbh->getProductInfo($idProduct);

    $templateParams["prodotticasuali"] = $dbh->getRandomProducts();
    $templateParams["navbarFixed"] = "";

    //Presentazione
    require_once("template/base.php");

?>