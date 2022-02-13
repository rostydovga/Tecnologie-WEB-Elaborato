<div class="container">
    <div class="row text-center my-4">
        <h2>Complete your order</h2>
    </div>
    <form method="POST" action="#">
        <div class="row">
            <div class="col-lg-4">
                <div class="row text-center">
                    <h3>Payment card details</h3>
                </div>
                <div class="row my-4">
                    <div class="card border-dark payment">
                        <div class="card-body py-3 px-1 m-3">
                            <div class="row">
                                <div class="col-4">
                                    <label for="numero">Card number :</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="numero" name="numerocarta" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4">
                                    <label for="scadenza">Expire date :</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="scadenza" name="scadenza" />
                                </div>
                                <div class="col-2 text-end">
                                    <label for="cvv">CVV :</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" id="cvv" name="cvv" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4">
                                    <label for="proprietario">Holder name :</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="proprietario" name="proprietario" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <div class="row mb-4 text-center">
                    <h3>Your cart</h3>
                </div>
                <div class="row">

                    <?php foreach($templateParams["prodotticarrello"] as $prodotto): ?>
                    <div class="card bg-white border-dark mb-2">
                        <div class="row no-gutters">
                            <div class="col-2 text-center">
                                <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"]; ?>" class="card-img" alt="" />
                            </div>
                            <div class="col-10">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="m-0"><?php echo $prodotto["Nome"]; ?></p>
                                        </div>
                                        <div class="col-3">
                                            <p class="m-0"><?php echo $prodotto["QuantNelCarrello"]; ?> qty</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="m-0"><?php echo $prodotto["Prezzo"]; ?> €</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="row justify-content-between mt-3">
                    <div class="col-3">
                        <h4>Total:</h4>
                    </div>
                    <div class="col-3 text-end">
                        <h4><?php echo $templateParams["totale"][0]["ImportoTotale"]; ?> €</h4>
                        <button class="btn btn-dark m-0" type="submit">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 text-center">
            <p>* Please note: your order will be delivered at Cesena Campus (University of Bologna), Dell'Universit&aacute; Street 50 (47521 Cesena FC).</p>
        </div>
    </form>
</div>