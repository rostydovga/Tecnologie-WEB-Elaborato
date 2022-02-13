<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $templateParams["titolo"] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="upload/logo.png">
    <link rel="stylesheet" href="css/style.css">

    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Corinthia&family=Cormorant+Garamond&display=swap" rel="stylesheet">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="script/jquery_functions.js"></script>
    <script src="script/registrationjs.js"></script>
    <script src="script/login-home.js"></script>
    <script src="script/filter-products.js"></script>
</head>

<body>
    <!--Offcanvas Cart-->
    <div class="offcanvas offcanvas-end" id="offcanvas-cart">
        <!--<div class="offcanvas-header">-->
        <div class="row">
            <section>
                <div class="row mt-4">
                    <div class="col-10">
                        <header>
                            <h2 class="offcanvas-title">Your cart</h2>
                        </header>
                    </div>
                    <div class="col-2 mt-3">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                </div>
                <div class="row">
                    <div class="offcanvas-body">
                        <?php if(isset($_SESSION["Ordine"]) && isset($_SESSION["IdUtente"])) :
                            foreach($carrello->getProducts($_SESSION["IdUtente"], $_SESSION["Ordine"]) as $prodotto): ?>
                            <div class="card">
                            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"]; ?>" class="card-img-left" alt="">
                            <div class="card-body">
                                <div class="row mx-2">
                                    <h3><?php echo $prodotto["Nome"]; ?></h3>
                                    <hr/>
                                    <div class="col col-6">
                                        <div class="input-group">
                                            <input type="number" class="qty-input form-control" maxlength="2" max="<?php echo $prodotto["QuantMax"]; ?>" min="0" value="<?php echo $prodotto["QuantNelCarrello"]; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-6">
                                        <p>Price: <?php echo $prodotto["Prezzo"]; ?>€</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <footer>
            <hr/>
            <div class="row">
                <div class="col col-6">
                    <p>Subtotal:</p>
                </div>
                <div class="col col-6">
                    <?php if(isset($_SESSION["Ordine"]) && isset($_SESSION["IdUtente"]) && !count($dbh->isAdmin($_SESSION["IdUtente"]))) : ?>
                    <p>€ <?php echo $carrello->getSubtotal($_SESSION["IdUtente"], $_SESSION["Ordine"])[0]["ImportoTotale"]; ?></p>
                    <?php else: ?>
                    <p>€ 0.00</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row ">
                <!--<button class="btn bg-dark " type="button">Check-out</button>-->
                <a class="btn btn-block bg-dark" type="submit" href="confirmation.php">Check-out</a>
            </div>
        </footer>
        <!--</div>-->
    </div>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg py-4 <?php echo isset($templateParams["navbarFixed"]) ? $templateParams["navbarFixed"]:""; ?> navbar-dark">
        <div class="container">
            <header>
                <a href="index.php" class="navbar-brand d-flex justify-content-between align-items-center order-lgs-0">
                    <h1>C&D</h1>
                </a>
            </header>
            <div class="order-lg-2 nav-btns m-0">
                <div class="dropdown">
                    <button class="btn position-relative" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell"></i>
                <!--pin rosso sulla notifica-->
                <span class="position-absolute top-0 start-0  translate-middle p-1 rounded-circle bg-primary"></span>
              </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <p class="dropdown-item">Notifica-1</p>
                        </li>
                        <li>
                            <p class="dropdown-item">Notifica-2</p>
                        </li>
                        <li>
                            <p class="dropdown-item">Notifica-3</p>
                        </li>
                    </ul>

                </div>
                <a href="login.php" role="button" class="btn position-relative">
                    <i class="bi bi-person"></i>
                    <span class="position-relative top-10 start-15  translate-middle badge bg-primary"></span>
                </a>
                <button type="button" class="btn position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart">
                <i class="bi bi-cart"></i>
                <?php if(!$carrello->isEmpty()): ?>
                <span class="position-absolute top-0 start-0  translate-middle p-1 rounded-circle bg-primary"></span>
                <?php endif; ?>
            </button>
            </div>
            <!--Per la compressione della pagina-->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse order-lgs-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item px-1 py-2">
                        <a class="nav-link" href="fragrances.php">Fragrances</a>
                    </li>
                    <li class="nav-item px-1 py-2 border-0">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 


    <main>
        <?php    
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }   
            ?>
    </main>

    <!--Footer-->
    <footer class="text-center text-white">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section>
                <h2>Find us here</h2>
                <!-- Facebook -->
                <a class="btn btn-link btn-floating btn-lg m-1" href="#" role="button" data-mdb-ripple-color="dark">
                    <i class="bi bi-facebook"></i>
                </a>

                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button" data-mdb-ripple-color="dark">
                    <i class="bi bi-twitter"></i>
                </a>

                <!-- Google -->
                <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="bi bi-google"></i
        ></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button"><i class="bi bi-instagram"></i
        ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3">
            © 2022 Copyright:
            <a class="" href="index.html">C&D</a>
        </div>
        <!-- Copyright -->
    </footer>

</body>

</html>