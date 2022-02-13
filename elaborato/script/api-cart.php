<?php

    require_once("../bootstrap.php");
    
    $dbh->setProductQuantityInCart($_SESSION["IdUtente"], $_POST["IdProdotto"], $_SESSION["Ordine"], $_POST["QuantNelCarrello"]);

?>