<?php if(isset($templateParams["utente_registrato"])): ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"><?php echo $templateParams["modal-title"]; ?></h5>
            <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
        </div>
        <div class="modal-body">
            <?php echo $templateParams["modal-text"]; ?>
        </div>
        <div class="modal-footer">
            <a type="button" href="<?php echo $templateParams["on-close"]; ?>" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <a type="button" href="<?php echo $templateParams["on-ok"]; ?>" class="btn btn-primary">Confirm</a>
        </div>
    </div>
</div>
</div>
<?php endif; ?>


<section class="mt-5">
    <div class="container-fluid">
    <div class="row px-3">
        <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="card-body">
            <header>
                <h1 class="title text-center mt-4">
                    Registration
                </h1>
            </header>
            <form class="mt-5" action="" method="POST">
                <div class="form-outline mb-4">
                    <label class="form-label" for="formFirstName">First name</label>
                    <input type="text" id="formFirstName" class="form-control form-control-lg" placeholder="Your first name" name="nome" required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="formLastName">Last Name</label>
                    <input type="text" id="formLastName" class="form-control form-control-lg" placeholder="Your last name" name="cognome" required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="formEmail">Your Email</label>
                    <input type="email" id="formEmail" class="form-control form-control-lg" placeholder="your@email.com" name="email" required/>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="formPassword">Password</label>
                    <input type="password" id="formPassword" class="form-control form-control-lg" placeholder="Password" name="password" required/>
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn bg-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="registerButton">Register</button>
                </div>
                <hr class="my-4"/>
                <p class="text-center text-muted">Have already an account? <a href="login.php" class="">Login here</a></p>
               
            </form>
        </div>
        <div class="img-right d-none d-md-flex bg-dark"></div>
        </div>  
    </div>
    </div>
</section>


