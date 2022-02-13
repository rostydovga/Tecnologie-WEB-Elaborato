<div class="container">
    <article>
        <header class="text-center my-5">
            <h2>
            <?php if(isset($templateParams["header"])): ?>
                <?php echo $templateParams["header"]; ?>
            <?php else: ?>
                Create and Add a New
            <?php endif; ?>
                Product
            </h2>
        </header>
        <section class="product">
            <form method="POST" action="fragrances.php<?php echo isset($_GET["id"]) ? "?id=".$_GET["id"] : ""; ?>">
                <div class="row my-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="nome">Name</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="<?php echo  isset($templateParams["infoProdotto"])? $templateParams["infoProdotto"]["NomeProdotto"] : "" ;?>" id="nome" name="nome" />
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="cat">Category</label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select" name="cat" id="cat">
                            <?php foreach($templateParams["categorie"] as $categoria) : ?>
                            <option <?php echo isset($templateParams["infoProdotto"])? ($templateParams["infoProdotto"]["Categoria"]==$categoria["Nome"] ? "selected" : "") : "" ;?> ><?php echo $categoria["Nome"]; ?></option>  
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="gender">Target</label>
                    </div>
                    <div class="col-lg-3">
                        <!-- Aggiungere selected del profumo corrente -> STICAZZI -->
                        <select class="form-select" name="gender" id="gender">
                            <option value="m">Male</option>  
                            <option value="f">Female</option>  
                            <option value="u">Unisex</option>  
                        </select>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="prezzo">Price</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="<?php echo  isset($templateParams["infoProdotto"])? $templateParams["infoProdotto"]["Prezzo"] : "" ;?>" id="prezzo" name="prezzo" />
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="ml">Capacity (ml)</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="<?php echo  isset($templateParams["infoProdotto"])? $templateParams["infoProdotto"]["Ml"] : "" ;?>" id="ml" name="ml" />
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="quantita">Quantity</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="<?php echo  isset($templateParams["infoProdotto"])? $templateParams["infoProdotto"]["Quantita"] : "" ;?>" id="quantita" name="quantita" />
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="desc">Description</label>
                    </div>
                    <div class="col-lg-3">
                        <textarea class="form-control"  id="desc" name="desc" rows="3"><?php echo  isset($templateParams["infoProdotto"])? $templateParams["infoProdotto"]["Descrizione"] : "" ;?></textarea>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label class="form-label" for="imm">Upload Image</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="file" class="form-control-file" id="imm" name="imm" />
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button class="btn bg-dark" name="<?php echo isset($templateParams["header"]) ? "modificaprodotto" : "aggiungiprodotto" ?>" type="submit">Confirm</button>
                    </div>
                </div>
            </form>
        </section>
    </article>
</div>