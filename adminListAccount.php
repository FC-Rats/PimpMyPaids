<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Liste des comptes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/img/logo.ico">
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/query.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include('./header.php'); ?>
    <div class="container po-list-accounts-section">
        <h1 class="p-4 text-center">Liste des clients</h1>
        <!-- $accountInfo -->
        <div class="accordion accordion-flush py-3 mb-3" id="accordionFlushExample">
            <div class="accordion-item my-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed rounded compte pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <span class="col-3 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span class="col-6 col-md-3">RAISON SOCIALE</span>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="infos d-flex flex-wrap pb-2">
                            <span class="col-12 col-sm-7 col-md-9">Email : <span class="emailCustomer">lolodelastreet@gmail.com</span></span>
                            <span class="col-8 col-sm-4 col-md-2">DEVISE : <span class="currency">EUR</span></span>
                            <span class="col-4 col-sm-1 col-lg-1 d-flex justify-content-end clear-button align-items-center">
                                <div class="btn border-0" onclick="deleteCustomer(siren);"><i class="fa-solid fa-trash fa-xl"></i></div>
                            </span>
                            <br>
                            <span class="col-12">Login : <span class="login">LoloLaBosse</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item my-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed rounded compte pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <span class="col-3 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span class="col-6 col-md-3">RAISON SOCIALE</span>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="infos d-flex flex-wrap pb-2">
                            <span class="col-12 col-sm-7 col-md-9">Email : <span class="emailCustomer">lolodelastreet@gmail.com</span></span>
                            <span class="col-8 col-sm-4 col-md-2">DEVISE : <span class="currency">EUR</span></span>
                            <span class="col-4 col-sm-1 col-lg-1 d-flex justify-content-end clear-button align-items-center">
                                <div class="btn border-0" onclick="deleteCustomer(siren);"><i class="fa-solid fa-trash fa-xl"></i></div>
                            </span>
                            <br>
                            <span class="col-12">Login : <span class="login">LoloLaBosse</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item my-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed compte rounded pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                        <span class="col-3 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span class="col-6 col-md-3">RAISON SOCIALE</span>
                    </button>
                </h2>
                <div id="flush-collapse3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="infos d-flex flex-wrap pb-2">
                            <span class="col-12 col-sm-7 col-md-9">Email : <span class="emailCustomer">lolodelastreet@gmail.com</span></span>
                            <span class="col-8 col-sm-4 col-md-2">DEVISE : <span class="currency">EUR</span></span>
                            <span class="col-4 col-sm-1 col-lg-1 d-flex justify-content-end clear-button align-items-center">
                                <div class="btn border-0" onclick="deleteCustomer(siren);"><i class="fa-solid fa-trash fa-xl"></i></div>
                            </span>
                            <br>
                            <span class="col-12">Login : <span class="login">LoloLaBosse</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('./footer.php'); ?>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- HighCharts JS -->
    <script src="assets/js/highcharts.js"></script>
</body>

</html>