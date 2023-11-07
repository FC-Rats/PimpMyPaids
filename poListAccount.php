<!DOCTYPE html>
<html>

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
                <form class="d-flex align-items-center justify-content-between">
                    <div class="form-floating text-dark">
                        <input type="text" class="form-control" id="SIREN" name="SIREN" placeholder=" ">
                        <label for="SIREN">N° SIREN</label>
                    </div>
                    <div class="form-floating text-dark">
                        <input type="text" class="form-control" id="RaisonSociale" name="RaisonSociale" placeholder=" ">
                        <label for="RaisonSociale">Raison Sociale</label>
                    </div>
                    <div class="form-floating text-dark">
                        <input type="number" class="form-control" id="Montant" name="Montant" placeholder=" ">
                        <label for="Montant">Montant</label>
                    </div>
                    <div class="form-floating text-dark">
                        <input type="date" class="form-control ps-4" id="Date" name="Date" placeholder=" ">
                        <label for="Date">Date</label>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <input class="form-check-input stay-connected-checkbox" type="checkbox" value="0" id="Impaye">
                        <label class="form-check-label label-stay-connected" for="Impaye">
                            Impayés
                        </label>
                    </div>
                    <div class="form-floating text-dark d-flex align-items-center justify-content-between">
                            <button type="submit" id="search-login-button" class="btn btn-primary border-0 text-uppercase d-flex align-items-center px-2 py-2 px-md-3">
                                <span class="me-2 fs-5 text-start">Rechercher</span>
                                <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                            </button>
                    </div>
                </form>
            </div>
            <div class="headquery d-flex align-items-center justify-content-between mt-5">
            <span>X comptes</span>
                <div class="export d-flex flex-row-reverse align-items-baseline">
                    <button class="btn btn-primary border-0">
                        <span id="Export" class="col-6 col-md-1 flex-end">Trier</span>
                        <i class="fa-solid fa-file-export"></i>
                    </button>
                </div>
            </div>
            <div class="accordion accordion-flush py-3 mb-3" id="accordionFlushExample">
                <div class="accordion-item my-3">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed rounded compte pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <span id="Siren" class="col-6 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span id="RaisonSociale" class="col-6 col-md-2">RAISON SOCIALE</span>
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="infos d-flex">
                                <span id="Transactions" class="col-6">X transactions</span>
                                <span id="Sens" class="col-1">+-</span>
                                <span id="Montant" class="col-2">RAISON SOCIALE</span>
                                <span id="Devise" class="col-1">(EUR)</span>
                            </div>
                            <div class="export d-flex flex-row-reverse align-items-baseline">
                                <button class="btn btn-primary border-0">
                                <span id="Export" class="col-6 col-md-1 flex-end">Exporter</span>
                                <i class="fa-solid fa-file-export"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item my-3">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed rounded compte danger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <span id="Siren" class="col-6 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span id="RaisonSociale" class="col-6 col-md-2">RAISON SOCIALE</span>
                    </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="infos d-flex">
                                <span id="Transactions" class="col-6">X transactions</span>
                                <span id="Sens" class="col-1">+-</span>
                                <span id="Montant" class="col-2">RAISON SOCIALE</span>
                                <span id="Devise" class="col-1">(EUR)</span>
                            </div>
                            <div class="export d-flex flex-row-reverse align-items-baseline">
                                <button class="btn btn-primary border-0">
                                <span id="Export" class="col-6 col-md-1 flex-end">Exporter</span>
                                <i class="fa-solid fa-file-export"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item my-3">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed compte rounded pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                        <span id="Siren" class="col-6 col-md-1">SIREN</span>
                        <span class="col-1">-</span>
                        <span id="RaisonSociale" class="col-6 col-md-2">RAISON SOCIALE</span>
                    </button>
                    </h2>
                    <div id="flush-collapse3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="infos d-flex">
                                <span id="Transactions" class="col-6">X transactions</span>
                                <span id="Sens" class="col-1">+-</span>
                                <span id="Montant" class="col-2">RAISON SOCIALE</span>
                                <span id="Devise" class="col-1">(EUR)</span>
                            </div>
                            <div class="export d-flex flex-row-reverse align-items-baseline">
                                <button class="btn btn-primary border-0">
                                <span id="Export" class="col-6 col-md-1 flex-end">Exporter</span>
                                <i class="fa-solid fa-file-export"></i>
                                </button>
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