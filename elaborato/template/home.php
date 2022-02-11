
    <!-- Carousel -->
    <div id="carousel" class="carousel slide mt-5" data-bs-ride="carousel">
        <!-- Indicators/dots -->
        <div class="carousel-indicators ">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="3"></button>
        </div>
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="upload/Carusel1.jpg" alt="" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="upload/Carusel2.jpg" alt="" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="upload/Carusel3.jpg" alt="" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="upload/Carusel4.jpg" alt="" class="d-block" style="width:100%">
            </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
    </div>


<!--Section Products-->
<section class="product">
    <div class="container-md">
        <div class="row pt-5 pb-2">
            <div class="col-lg-12 m-auto">
                <h2>Our Products</h2>
            </div>
        </div>
        <div class="row mt-2">
        <?php foreach($templateParams["prodotticasuali"] as $prodotto): ?>
            <div class="col-lg-3 text-center">
                <div class="card border-0 mb-2">
                    <div class="card-body">
                        <a href="product.php?id=<?php echo $prodotto["IdProdotto"] ?>" >
                            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"] ?>" alt="<?php echo $prodotto["Immagine"] ?>" class="img-fluid "/>
                        </a>
                    </div>
                    <hr/>
                    <h3><?php echo $prodotto["Nome"]; ?> </h3>
                    <p><?php echo "€ ".$prodotto["Prezzo"]; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
            <div class="row text-center">
                <a class="btn btn-block bg-dark" type="submit" href="fragrances.php">
            View Products
        </a>
            </div>
        </div>
    </div>
</section>