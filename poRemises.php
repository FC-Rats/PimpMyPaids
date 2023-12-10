<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Liste des remises</title>
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
    <!-- listRemittances.php -->
    <?php include('./header.php'); ?>
    <div class="container remise-section">
        <h1 class="p-4 text-center">Liste des remises clients</h1>
        <div class="searchnavbar bg-grey d-flex border border-dark ">
            <form class="d-flex align-items-center justify-content-around justify-content-lg-between" onsubmit="return false">
                <div class="form-floating text-dark col-12 col-sm-6 col-lg-2">
                    <input type="text" class="form-control" name="siren" id="siren" placeholder=" ">
                    <label for="siren">N° SIREN</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-6 col-lg-2">
                    <input type="text" class="form-control" name="companyName" id="companyName" placeholder=" ">
                    <label for="companyName">Raison Sociale</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-12 col-lg-2">
                    <input type="text" class="form-control" name="remittanceNumber" id="remittanceNumber" placeholder=" ">
                    <label for="remittanceNumber">N° Remise</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-6 col-lg-2">
                    <input type="date" class="form-control ps-4 hidden" id="beforeDate" name="beforeDate" placeholder="">
                    <label for="beforeDate">Avant le</label>
                </div>
                <div class="form-floating text-dark col-12 col-sm-6 col-lg-2">
                    <input type="date" class="form-control ps-4" id="afterDate" name="afterDate" placeholder=" ">
                    <label for="afterDate">Après le</label>
                </div>
                <div class="form-floating text-dark d-flex align-items-center justify-content-between">
                    <button type="button" id="searchRemittances" class="btn btn-primary border-0 text-uppercase d-flex align-items-center px-2 py-2 px-md-3 col-12">
                        <span class="me-2 fs-5 text-start">Rechercher</span>
                        <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="headquery d-flex flex-row flex-wrap align-items-center justify-content-between mt-5 border-black border-bottom ">
            <div class="d-flex flex-row flex-wrap col-12 col-sm-auto">
                <span class="pe-2"><span id="countResults">X</span> résultats -</span>
                <span class="d-flex flex-row">Afficher<input type="number" id="nbLineByPage" class="pagi mx-2" placeholder="3" value="3" min="1" max="100" style="min-width: 50px!important; max-height: 30px!important;" />lignes par page</span>
            </div>
            <div class="export d-flex flex-row-reverse align-items-baseline col-12 col-sm-auto">
                <form class="d-flex align-items-center justify-content-around justify-content-lg-between mb-1">
                    <input type="hidden" name="context" value="poRemises" id="context">
                    <select class=" d-flex form-select btn btn-primary border-0 p-1 pe-5" name="export_type" id="export_type">
                        <option value="noExport" selected>Exporter les données</option>
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                        <option value="xls">XLS</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="d-flex flex-row my-1">
            <span class="d-flex flex-row">Afficher la page<input type="number" id="pageToShow" class="pagi mx-2" placeholder="1" value="1" min="1" style="width:15%!important; min-width: 50px!important;" /></span>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDetailRemittancePo" aria-labelledby="offcanvasDetailRemittancePoLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasDetailRemittancePoLabel">Détail Remises <br> Compte : <span id="companyNameDetail">RAISON SOCIALE</span> <br> N° : <span id="idRemittanceDetail">Remise</span></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" id="offcanvas-body">
            </div>
        </div>
        <div class="container-remise-list" id="container-remise-list">
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
    <script src="assets/js/poRemises.js"></script>
</body>

</html>