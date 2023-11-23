<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Espace Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/img/logo.ico">
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientSpace.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>

    <div class="container espace-client-section">
        <div class="row container-cols-espace-client">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pt-4">
                <div>
                    <div class="pb-5">
                        <h2>Content de vous revoir parmi nous,</h2>
                        <h1><span id="clientName">NOM</span> <span id="clientFirstName">Prénom</span></h1>
                    </div>
                    <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12">
                        <span class="col-4">Votre solde :</span>
                        <span class="fw-bold col-4" id="clientBalance">-10000,00</span>
                        <span class="col-1 clientCurrency">EUR</span>
                        <i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-3"></i>
                    </div>
                    <div class="align-items-center justify-content-center text-center pt-5 d-none d-sm-block">
                        <img class="p-2 img-fluid" src="assets/img/profile.svg" alt="Profil de compte" title="Profil de compte" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center pt-4">
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12">
                    <figure class="highcharts-figure col-12">
                        <div id="container-soldes"></div>
                    </figure>
                </div>
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12 my-2">
                    <span class="col-4">Somme remises :</span>
                    <span class="fw-bold col-4" id="clientRemittances">1000,00</span>
                    <span class="col-1 clientCurrency">EUR</span>
                    <i class="fa-solid fa-money-bill-transfer fa-xl col-3"></i>
                </div>
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12 my-2">
                    <span class="col-4">Somme impayés :</span>
                    <span class="fw-bold col-4" id="clientUnpaids">-10000,00</span>
                    <span class="col-1 clientCurrency">EUR</span>
                    <i class="fa-solid fa-file-invoice-dollar fa-xl col-3"></i>
                </div>
                <div class="p-3 fs-5 d-flex align-items-center justify-content-center text-center col-12">
                    <span>Pour apprendre à mieux gérer ses soldes : <a href="https://www.wikihow.com/Improve-Your-Sales" target="_blank" class="text-decoration-none" title="Pour apprendre à mieux gérer ses soldes">cliquez ici</a></span>
                </div>
            </div>
        </div>
    </div>



    <?php include('./footer.php'); ?>
    <script src="assets/js/clientSpace.js"></script>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>