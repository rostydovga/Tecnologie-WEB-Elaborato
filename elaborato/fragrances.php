<?php

    require_once("bootstrap.php");

    $templateParams["titolo"] = "C&D Fragrances";
    $templateParams["nome"] = "fragrances_list.php";
    $templateParams["prodotti"] = $dbh->getProducts();
    $templateParams["categorie"] = $dbh->getCategories();


    require_once("template/base.php");

?>