<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
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
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientUnpaids.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <!-- listUnpaids.php -->
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/highcharts-3d.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>
    <?php include('./includes/getClientUnpaids.php'); ?>

    <div class="conteuneur container client-unpaids-section align-items-center jsutify-content-center">
        <h1 class="p-4 text-center">Vos Impayés</h1>
        <div class="col-12 text-center rounded-2 p-2 mb-2 fs-3" id="sumUnpaids">Somme totale : <span id="clientSumUnpaids" class="fw-bold"><?php echo $datas[0]["sumImpayes"]; ?></span> <span id="clientCurrency"><?php echo $datas[0]["currency"]; ?></span></div>
        <div class="d-flex flex-row flex-wrap">
            <div class="searchnavbar bg-grey d-flex border border-dark col-12 col-md-5 p-0" style="height: auto!important;">
                <form class="d-flex align-items-center justify-content-around" id="formClientUnpaids" onsubmit="return false">
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="beforeDate" name="beforeDate" placeholder=" ">
                        <label for="beforeDate">Avant le</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="afterDate" name="afterDate" placeholder=" ">
                        <label for="afterDate">Après le</label>
                    </div>
                    <div class="text-dark d-flex align-items-center justify-content-between col-12 col-sm-5">
                        <select class="" aria-label="formExportClientDataUnpaids" name="label" id="label" style="max-width: 200px;">
                            <option value="" selected>Motif</option>
                            <option value="Fraude à la carte">Fraude à la carte</option>
                            <option value="Compte à découvert">Compte à découvert</option>
                            <option value="Compte clôturé">Compte clôturé</option>
                            <option value="Compte bloqué">Compte bloqué</option>
                            <option value="Provision insuffisante">Provision insuffisante</option>
                            <option value="Opération contestée par le débiteur">Opération contestée par le débiteur</option>
                            <option value="Titulaire décédé">Titulaire décédé</option>
                            <option value="Raison non communiquée, contactez la banque du client">Raison non communiquée, contactez la banque du client</option>
                            <option value="Autre raison">Autre raison</option>
                        </select>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="idUnpaid" name="idUnpaid" placeholder=" ">
                        <label for="idUnpaid">Numéro Dossier</label>
                    </div>
                    <div class="text-dark d-flex align-items-center justify-content-between col-12 col-sm-5">
                        <select class="form-select" id="formSortClientUnpaids">
                            <option value="noSorting" selected>Trier par montant</option>
                            <option value="az">Ordre croissant</option>
                            <option value="za">Odre décroissant</option>
                        </select>
                    </div>
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
        <div class="headquery d-flex align-items-center justify-content-between mt-5 border-bottom border-black">
            <span><span id="countResults">X</span> résultat(s)</span>
            <input type="hidden" name="context" value="clientUnpaids" id="context">
            <select class="form-select mb-2" aria-label="formExportClientDataUnpaids" name="export_type" id="export_type">
                <option value="noExport" selected>Exporter les données</option>
                <option value="pdf">PDF</option>
                <option value="csv">CSV</option>
                <option value="xls">XLSX</option>
            </select>
        </div>
        <div id="container-unpaid-list">
        </div>
    </div>
    <?php include('./footer.php'); ?>

    <script>
        var siren = <?php echo json_encode($_SESSION["siren"]); ?>;
    </script>

    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- JS -->
    <script src="assets/js/clientUnpaids.js"></script>
</body>

</html>