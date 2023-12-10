<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Liste des impayés</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/img/logo.ico">
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/query.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/searchnavbar.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/poUnpaids.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/highcharts-3d.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>
    <div class="container po-unpaids-section">
        <h1 class="p-4 text-center">Liste des impayés clients</h1>
        <div class="d-flex flex-row flex-wrap">
            <div class="searchnavbar bg-grey d-flex border border-dark col-12 col-md-5 p-0">
                <form class="d-flex align-items-center justify-content-around" id="formPoUnpaids" onsubmit="return false">
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="siren" name="siren" placeholder=" ">
                        <label for="siren">N° SIREN</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder=" ">
                        <label for="companyName">Raison Sociale</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="beforeDate" name="beforeDate" placeholder=" ">
                        <label for="beforeDate">Avant le</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="afterDate" name="afterDate" placeholder=" ">
                        <label for="afterDate">Après le</label>
                    </div>
<!--                     <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="label" name="label" placeholder=" ">
                        <label for="label">Motif</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="idUnpaid" name="idUnpaid" placeholder=" ">
                        <label for="idUnpaid">Numéro Dossier</label>
                    </div> -->
                    <div class="form-floating text-dark d-flex align-items-center justify-content-between mt-1 mb-2 mb-lg-0">
                        <button type="button" id="searchUnpaidsButton" class="btn btn-primary border-0 text-uppercase d-flex align-items-center px-2 py-2 px-md-3 col-12">
                            <span class="me-2 fs-5 text-start">Rechercher</span>
                            <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-7 mt-2 mt-md-0">
                <div class="chart-container border border-1 border-black ms-2 rounded-2 p-2">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDetailUnpaidClient" aria-labelledby="offcanvasDetailUnpaidClientLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasDetailUnpaidClientLabel">Impayés de <span id="nameCompany">Nom entreprise</span></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column" id="offcanvas-body">
            </div>
        </div>
        <div class="headquery d-flex align-items-center justify-content-between mt-5 border-bottom border-black">
            <span><span id="nbResults">X</span> résultats - Somme des impayés par Raison Sociale</span>
            <div class="export d-flex flex-row-reverse align-items-baseline">
                <form class="d-flex align-items-center justify-content-around justify-content-lg-between mb-1">
                    <input type="hidden" name="context" value="poUnpaids" id="context">
                    <select class="d-flex form-select btn btn-primary border-0 p-1 pe-5" name="export_type" id="export_type">
                        <option value="noExport" selected>Exporter les données</option>
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                        <option value="xls">XLS</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="container-unpaid-list" id="container-unpaid-list">
        </div>
    </div>
    <?php include('./footer.php'); ?>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- JS -->
    <script src="assets/js/poUnpaids.js"></script>
</body>

</html>