<!DOCTYPE html>
<html>

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
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/highcharts-3d.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>
    <div class="container po-unpaids-section align-items-center jsutify-content-center">
        <h1 class="p-4 text-center">Vos Impayés</h1>
        <div class="col-12 text-center rounded-2 p-2 mb-2 fs-3" id="sumUnpaids">Somme totale</div>
        <div class="d-flex flex-row flex-wrap">
            <div class="searchnavbar bg-grey d-flex border border-dark col-12 col-md-5 p-0" style="height: auto!important;">
                <form class="d-flex align-items-center justify-content-around" id="formPoUnpaids">
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="beforeDate" name="beforeDate" placeholder=" ">
                        <label for="beforeDate">Avant le</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="date" class="form-control ps-4" id="afterDate" name="afterDate" placeholder=" ">
                        <label for="afterDate">Après le</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="motif" name="motif" placeholder=" ">
                        <label for="motif">Motif</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="number" class="form-control" id="numDossier" name="numDossier" placeholder=" ">
                        <label for="numDossier">Numéro Dossier</label>
                    </div>
                    <div class="text-dark d-flex align-items-center justify-content-between">
                        <select class="form-select" aria-label="formSortClientUnpaids">
                            <option selected>Trier les impayés</option>
                            <option value="az">Ordre croissant</option>
                            <option value="za">Odre décroissant</option>
                        </select>
                    </div>
                    <div class="form-floating text-dark d-flex align-items-center justify-content-between mt-1 mb-2 mb-lg-0">
                        <button type="submit" id="search-login-button" class="btn btn-primary border-0 text-uppercase d-flex align-items-center px-2 py-2 px-md-3 col-12">
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
            <span>X résultats</span>
            <select class="form-select mb-2" aria-label="formExportClientDataUnpaids">
                <option selected>Exporter les données</option>
                <option value="pdf">PDF</option>
                <option value="csv">CSV</option>
                <option value="xls">Xls</option>
            </select>
        </div>
        <div class="container-unpaid-list">
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="dateVente">Date vente</span>
                <span class="col-12 col-sm-6 col-lg-1" id="dateRemise">Date remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="reseau">Reseau</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numCarte">N° carte</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numDossier">N° dossier impayé</span>
                <span class="col-12 col-sm-6 col-lg-1" id="sens">-</span>
                <span class="col-12 col-sm-6 col-lg-1" id="montant">Montant</span>
                <span class="col-12 col-sm-6 col-lg-1" id="devise">Devise</span>
                <span class="col-12 col-sm-6 col-lg-2" id="libelle">Libellé</span>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="dateVente">Date vente</span>
                <span class="col-12 col-sm-6 col-lg-1" id="dateRemise">Date remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="reseau">Reseau</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numCarte">N° carte</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numDossier">N° dossier impayé</span>
                <span class="col-12 col-sm-6 col-lg-1" id="sens">-</span>
                <span class="col-12 col-sm-6 col-lg-1" id="montant">Montant</span>
                <span class="col-12 col-sm-6 col-lg-1" id="devise">Devise</span>
                <span class="col-12 col-sm-6 col-lg-2" id="libelle">Libellé</span>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="dateVente">Date vente</span>
                <span class="col-12 col-sm-6 col-lg-1" id="dateRemise">Date remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="reseau">Reseau</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numCarte">N° carte</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numDossier">N° dossier impayé</span>
                <span class="col-12 col-sm-6 col-lg-1" id="sens">-</span>
                <span class="col-12 col-sm-6 col-lg-1" id="montant">Montant</span>
                <span class="col-12 col-sm-6 col-lg-1" id="devise">Devise</span>
                <span class="col-12 col-sm-6 col-lg-2" id="libelle">Libellé</span>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="dateVente">Date vente</span>
                <span class="col-12 col-sm-6 col-lg-1" id="dateRemise">Date remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="reseau">Reseau</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numCarte">N° carte</span>
                <span class="col-12 col-sm-6 col-lg-2" id="numDossier">N° dossier impayé</span>
                <span class="col-12 col-sm-6 col-lg-1" id="sens">-</span>
                <span class="col-12 col-sm-6 col-lg-1" id="montant">Montant</span>
                <span class="col-12 col-sm-6 col-lg-1" id="devise">Devise</span>
                <span class="col-12 col-sm-6 col-lg-2" id="libelle">Libellé</span>
            </div>
        </div>
    </div>
    <?php include('./footer.php'); ?>
    <script src="assets/js/clientUnpaidsChart.js"></script>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>