<?php

    require_once("bootstrap.php");
    //if(isset($_POST["nome"]) && isset($_POST["price"]) && isset($_POST["description"])) //upload con $_FILE

    //se impostato il POST e GET id,allora sto modificando 
    if(isset($_POST["nome"]) && isset($_GET["id"])){
        
    }

    //se il get e settato allora devo modificare il prodotto
    if(isset($_GET["id"])){
        //template params per dire che sto modificando
        $templateParams["modificaOggetto"] = 1;
        $templateParams["infoProdotto"] = $dbh->getProductInfo($_GET["id"]);

    }else{
        $templateParams["titolo"] = "C&D Manage products";
    }

    $templateParams["nome"] = "manage.php";
    $templateParams["categorie"] = $dbh->getCategories();

    require_once("template/base.php");

?>