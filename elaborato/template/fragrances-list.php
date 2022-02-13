
<div class="container">
    <section class="product">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <h2>Our Products</h2>
            </div>
        </div>
        <div class="row mt-2">
            <?php for($i = 0; $i < count($templateParams["prodotti"]); $i++) : ?>
            <div class="col-lg-3 text-center">
                <div class="card border-0 mb-2">
                    <div class="card-body">
                        <a href="product.php?id=<?php echo $templateParams["prodotti"][$i]["IdProdotto"] ?>"><img src="<?php echo UPLOAD_DIR.$templateParams["prodotti"][$i]["Immagine"]; ?>" alt="<?php echo $templateParams["prodotti"][$i]["Nome"]; ?>" class="img-fluid" /></a>
                    </div>
                    <hr/>
                    <h3><?php echo $templateParams["prodotti"][$i]["Nome"]; ?></h3>
                    <p><?php echo $templateParams["prodotti"][$i]["Prezzo"]; ?></p>
                </div>
            </div>
            <?php 
            if($i != 0 && ($i+1) % 4 == 0 && $i != count($templateParams["prodotti"])) {
                echo '</div>';
                echo '<div class="row mt-2">';
            }
            endfor; ?>
        </div>
    </section>
</div>