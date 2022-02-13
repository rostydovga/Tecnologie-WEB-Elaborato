<!--Container Principale-->
<div class="container">
    <!--Immagine + Dettagli Prodotto-->
    <div class="row mt-5">
        <!--Immagine prodotto-->
        <div class="col col-12 col-md-5 col-sm-12">
            <img src="<?php echo UPLOAD_DIR.$templateParams["infoProdotto"]["Immagine"]; ?>" alt="gucci fragrance" />
        </div>
        <!--Dettagli prodotto -->
        <div class="col col-md-7 col-sm-12">
            <header>
                <h2><?php echo $templateParams["infoProdotto"]["NomeProdotto"]; ?></h2>
                <hr/>
                <h3><?php echo $templateParams["infoProdotto"]["Categoria"]; 
                echo isset($templateParams["infoProdotto"]["Sesso"]) ? ($templateParams["infoProdotto"]["Sesso"]=="f" ? " - Female" : ($templateParams["infoProdotto"]["Sesso"]=="m" ? " - Male" : " - Unisex") ) : "" ; ?></h3>
            </header>
            <?php if(isset($_SESSION["IdUtente"])): ?>
            <form action="product.php?<?php echo "id=".$templateParams["infoProdotto"]["IdProdotto"]; ?>" method="POST" >
            <?php else: ?>
            <form action="login.php" method="POST" >
            <?php endif; ?>
                <section>
                    <div class="row row-cols-2">
                        <p><?php echo $templateParams["infoProdotto"]["Ml"]." ml"; ?></p>
                        <p><?php echo "€ ".$templateParams["infoProdotto"]["Prezzo"]; ?> </p>
                    </div>
                    <hr/>
                    <div class="input-group">
                        <label for="prodQuantity">Quantity:</label>
                        <input id="prodQuantity" name="prodQuantity" type="number" class="form-control" value="1" min="1" max="<?php echo $templateParams["infoProdotto"]["Quantita"]; ?>" />
                    </div>
                </section>
                <div class="row">
                    <?php if(isset($_SESSION["IdUtente"]) && count($dbh->isAdmin($_SESSION["IdUtente"]))): ?>
                    <div class="col-12 col-md-6 text-center">
                        <button href="manage-products.php" name="modifyProduct" class="btn btn-block bg-dark " type="submit">Modify Products</button>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                        <button href="" name="deleteproduct" class="btn btn-block bg-dark " type="submit">Delete Products</button>
                    </div>
                    <?php else: ?>
                        <button class="btn bg-dark" name="aggiungialcarrello" type="submit">Add to Cart <i class="bi bi-cart"></i></button>
                    <?php endif; ?>  
                </div>
                </form>
        </div>


    </div>

    <!--Descrizione prodotto-->
    <div class="row">
        <section>
            <header>
                <h2>Description</h2>
            </header>
            <p>
                <?php echo $templateParams["infoProdotto"]["Descrizione"]; ?>
            </p>
        </section>
    </div>
    <hr/>

    <!--Consigliati-->
    <div class="row">
        <section class="product">
            <header>
                <h2>Recommended Products</h2>
            </header>
            <div class="row mt-2">
                <?php foreach($templateParams["prodotticasuali"] as $prodotto): ?>
                <div class="col-lg-3 text-center">
                    <div class="card border-0 mb-2">
                        <div class="card-body">
                            <a href="product.php?id=<?php echo $prodotto["IdProdotto"] ?>">
                                <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"] ?>" alt="<?php echo $prodotto["Immagine"] ?>" class="img-fluid " />
                            </a>
                        </div>
                        <hr/>
                        <h3><?php echo $prodotto["Nome"]; ?></h3>
                        <p><?php echo "€ ".$prodotto["Prezzo"]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
               
            </div>
        </section>
    </div>
</div>
