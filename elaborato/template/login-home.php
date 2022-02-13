<div class=" p-5 bg-image text-white rounded-2">
    <h2 class="display-2" >Welcome <?php echo $_SESSION["Nome"]; echo " ".$_SESSION["Cognome"]; ?></h2>
    <p>We are glad to see you here</p>
</div>
<section class="container mt-5">
    <?php if($templateParams["isAdmin"]): ?>
        <div class="row mt-5">
            <div class="text-center">
                <a href="manage-products.php" class="btn btn-block bg-dark " type="submit">Add Products</a>
            </div>
        </div>
    <?php else :  ?>
    <div class="row mt-5">
        <header>
            <h3>Your orders history</h3>
        </header>
        <section class="overflow-auto mt-2">
            <?php foreach($templateParams["storico"] as $ordine): ?>
            <p>Ordine numero <?php echo $ordine["NumeroOrdine"]; ?> effettuato in data <?php echo $ordine["DataOrdine"]; ?> 
            (totale € <?php echo $ordine["ImportoTotale"]; ?>) : <?php echo $ordine["Acquisti"]; ?>.</p>
            <?php endforeach; ?>
        </section>
    </div>
    <?php endif;  ?>
    <div class="row">
        <div class="mb-3 text-center">
            <button type="button" id="logoutButton" class="btn bg-dark" > Logout </button>
        </div>
    </div>
    
</section>

<!-- Modal -->
<div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Logout</h3>
      </div>
      <div class="modal-body">
        Logout Successfully
      </div>
      <div class="modal-footer">
        <a href="index.php" class="btn btn-primary bg-dark">Confirm</a>
      </div>
    </div>
  </div>
</div>