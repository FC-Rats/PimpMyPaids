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
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/searchnavbar.css" />
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
        <h1 class="p-4 text-center">Liste des comptes clients</h1>
        <div class="searchnavbar bg-grey d-flex border border-dark ">
            <!-- getAccounts.php -->
            <form id="poListAccountsForm" class="d-flex align-items-center justify-content-around justify-content-lg-between" onsubmit="return false">
                <div class="form-floating text-dark col-12 col-sm-5 col-lg-2 m-1">
                    <input type="text" class="form-control" id="siren" name="siren" placeholder=" ">
                    <label for="siren">N° SIREN</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-5 col-lg-2 m-1">
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder=" ">
                    <label for="companyName">Raison Sociale</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-5 col-lg-2 m-1">
                    <input type="date" class="form-control ps-4" id="date" name="date" placeholder=" ">
                    <label for="date">Date</label>
                </div>
                <div class="form-floating text-dark d-flex align-items-center justify-content-center col-12 col-sm-5 col-lg-2 m-1">
                    <button type="button" id="searchAccountsButton" class="btn btn-primary border-0 text-uppercase d-flex justify-content-center align-items-center px-2 py-2 px-md-3 col-12">
                        <span class="me-2 fs-5 text-start">Rechercher</span>
                        <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                    </button>
                </div>
                <div class="form-floating text-dark d-flex align-items-center justify-content-center col-12 col-sm-5 col-lg-2 m-1">
                    <select class="d-flex form-select btn btn-primary border-0 p-1 pe-5" id="sortAccount">
                        <!-- sortAccount -->
                        <option value="noSorting" selected>Trier</option>
                        <option value="siren">N° SIREN</option>
                        <option value="montant">MONTANT</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="headquery d-flex align-items-center justify-content-between mt-5 border-black border-bottom">
            <span><span id="numberAccounts">X</span> comptes</span>
            <div class="export d-flex flex-row-reverse align-items-baseline">
                <form class="d-flex align-items-center justify-content-around justify-content-lg-between mb-1">
                    <input type="hidden" name="context" value="poListAccount" id="context">
                    <select class="d-flex form-select btn btn-primary border-0 p-1 pe-5" name="export_type" id="export_type">
                        <option value="noExport" selected>Exporter les données</option>
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                        <option value="xls">XLS</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- $accountInfo -->
        <div class="accordion accordion-flush py-3 mb-3" id="accordionListAcounts">
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
                        <div class="infos d-flex flex-column flex-sm-row pb-2">
                            <span class="col-5 col-sm-5 col-md-6">X transactions</span>
                            <span class="col-1">+-</span>
                            <span class="col-4 col-sm-4 col-md-3">SOLDE</span>
                            <span class="col-2">(EUR)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item my-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed rounded compte danger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <span class="col-3 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span  class="col-6 col-md-3">RAISON SOCIALE</span>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="infos d-flex flex-column flex-sm-row pb-2">
                            <span  class="col-5 col-sm-5 col-md-6">X transactions</span>
                            <span  class="col-1">+-</span>
                            <span class="col-4 col-sm-4 col-md-3">RAISON SOCIALE</span>
                            <span class="col-2">(EUR)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item my-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed compte rounded pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                        <span class="col-3 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span  class="col-6 col-md-3">RAISON SOCIALE</span>
                    </button>
                </h2>
                <div id="flush-collapse3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="infos d-flex flex-column flex-sm-row pb-2">
                            <span  class="col-5 col-sm-5 col-md-6">X transactions</span>
                            <span  class="col-1">+-</span>
                            <span class="col-4 col-sm-4 col-md-3">RAISON SOCIALE</span>
                            <span class="col-2">(EUR)</span>
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
    <!-- JS -->
    <script src="assets/js/poListAccount.js"></script>
</body>

</html>