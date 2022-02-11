
<section class="mt-5">
    <div class="container">
    <div class="row px-3">
        <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex bg-dark"></div>
        <div class="card-body">
            <h1 class="title text-center mt-4">
            Login
            </h1>
            <form action="" method="POST" class="form-box px-3">
            <div class="form-input">
                <span><i class="bi bi-envelope"></i></span>
                <input type="email" placeholder="your@email.com" name="email" required>
            </div>
            <div class="form-input">
                <span><i class="bi bi-key"></i></span>
                <input type="password" placeholder="Password" name="password" required>
            </div>
           
            <div class="mb-3 text-center">
                <button class="btn btn-block bg-dark " type="submit">Login</button>
            </div>
            <hr class="my-4"/>

            <?php if(isset($templateParams["erroreLogin"])): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <p><?php echo $templateParams["erroreLogin"]; ?></p>
                </div>
            <?php endif; ?>
            <p class="text-center text-muted"> Don't have an account?
            <a href="registration.php">Register here</a></p>
            
            </form>
        </div>
        </div>  
    </div>
    </div>
</section>

