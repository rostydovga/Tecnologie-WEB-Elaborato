
<div class="container">
<div class="row">
    <div class="col-lg-2 mt-3">
        <aside class="bg-light py-3 px-2">
            <header>
                <h2>Filter products</h2>
            </header>
            <section class="mt-3">
                <h3>Category</h3>
                <ul>
                    <?php foreach($templateParams["categorie"] as $categoria) : ?>
                    <li>
                        <input type="checkbox" name="<?php echo $categoria["Nome"]; ?>" id="<?php echo $categoria["Nome"]; ?>" value="<?php echo $categoria["Nome"]; ?>" />
                        <label for="<?php echo $categoria["Nome"]; ?>"><?php echo $categoria["Nome"]; ?></label>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <section class="mt-3">
                <h3>Gender</h3>
                <ul>
                    <li>
                        <input type="checkbox" name="uomo" id="uomo" value="uomo" />
                        <label for="uomo">Male</label>
                    </li>
                    <li>
                        <input type="checkbox" name="donna" id="donna" value="donna" />
                        <label for="donna">Female</label>
                    </li>
                    <li>
                        <input type="checkbox" name="unisex" id="unisex" value="unisex" />
                        <label for="unisex">Unisex</label>
                    </li>
                </ul>
            </section>
            <section>
                <h3>Order by</h3>
                <ul>
                    <li>
                        <input type="radio" name="ordinamento" id="prezzo" value="prezzo" />
                        <label for="prezzo">Price</label>
                    </li>
                    <li>
                        <input type="radio" name="ordinamento" id="quantmag" value="quantmag" />
                        <label for="quantmag">Q.ty in stock</label>
                    </li>
                </ul>
            </section>
        </aside>

    </div>
    <section class="col-lg-10 product">
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
                        <a href="product.php?id=<?php echo $templateParams["prodotti"][$i]["IdProdotto"] ?>"><img src="<?php echo UPLOAD_DIR.$templateParams["prodotti"][$i]["Immagine"]; ?>" alt="" class="img-fluid" /></a>
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
</div>