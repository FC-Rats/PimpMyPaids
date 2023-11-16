<!DOCTYPE html>
<html>

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
    <?php include('./header.php'); ?>
    <div class="container remise-section">
        <h1 class="p-4 text-center">Liste des remises clients</h1>
        <div class="col-12 text-center rounded-2 p-2 mb-2 fs-3" id="sumRemises">Somme totale</div>
        <div class="searchnavbar bg-grey d-flex border border-dark ">
            <form class="d-flex align-items-center justify-content-around justify-content-lg-between">
                <div class="form-floating text-dark col-sm-6 col-lg-2">
                    <input type="text" class="form-control" id="SIREN" name="SIREN" placeholder=" ">
                    <label for="SIREN">N° SIREN</label>
                </div>
                <div class="form-floating text-dark col-sm-6 col-lg-2">
                    <input type="text" class="form-control" id="RaisonSociale" name="RaisonSociale" placeholder=" ">
                    <label for="RaisonSociale">Raison Sociale</label>
                </div>
                <div class="form-floating text-dark col-sm-12 col-lg-2">
                    <input type="number" class="form-control" id="Montant" name="Montant" placeholder=" ">
                    <label for="Montant">N° Remise</label>
                </div>
                <div class="form-floating text-dark col-sm-6 col-lg-2">
                    <input type="date" class="form-control ps-4 hidden" id="Date" name="Date" placeholder="">
                    <label for="Date">Avant le</label>
                </div>
                <div class="form-floating text-dark col-sm-6 col-lg-2">
                    <input type="date" class="form-control ps-4" id="Date" name="Date" placeholder=" ">
                    <label for="Date">Apres le</label>
                </div>
                <div class="form-floating text-dark d-flex align-items-center justify-content-between">
                    <button type="submit" id="search-login-button"
                        class="btn btn-primary border-0 text-uppercase d-flex align-items-center px-2 py-2 px-md-3 col-12">
                        <span class="me-2 fs-5 text-start">Rechercher</span>
                        <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="headquery d-flex align-items-center justify-content-between mt-5 border-black border-bottom ">
            <span>X résultats</span>
            <div class="export d-flex flex-row-reverse align-items-baseline">
                <form class="d-flex align-items-center justify-content-around justify-content-lg-between mb-1">
                    <select class=" d-flex form-select btn btn-primary border-0 p-1 pe-5"
                        aria-label="Default select example">
                        <option selected>Exporter les données</option>
                        <option value="1">PDF</option>
                        <option value="2">CSV</option>
                        <option value="3">XLSX</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="container-remise-list">
            <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numremise">N° Remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="datetraitement">11/22/3222</span>
                <span class="col-12 col-sm-6 col-lg-2" id="nbtransactions">X transactions</span>
                <span class="col-12 col-sm-6 col-lg-2" id="montant"> + Montant total (EUR)</span>
                <button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">+</button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Détail Remises Compte <br> RAISON SOCIALE - N° Remise</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                </div>
            </div>
            <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numremise">N° Remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="datetraitement">11/22/3222</span>
                <span class="col-12 col-sm-6 col-lg-2" id="nbtransactions">X transactions</span>
                <span class="col-12 col-sm-6 col-lg-2" id="montant"> + Montant total (EUR)</span>
                <button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">+</button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Détail Remises Compte <br> RAISON SOCIALE - N° Remise</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                </div>
            </div>
            <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numremise">N° Remise</span>
                <span class="col-12 col-sm-6 col-lg-1" id="datetraitement">11/22/3222</span>
                <span class="col-12 col-sm-6 col-lg-2" id="nbtransactions">X transactions</span>
                <span class="col-12 col-sm-6 col-lg-2" id="montant"> + Montant total (EUR)</span>
                <button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">+</button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Détail Remises Compte <br> RAISON SOCIALE - N° Remise</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
                    </div>
                    <div class="remise-element rounded-3 my-3 px-5 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center"
                        id="">
                        <span class="col-12 col-lg-6" id="Datevente">Date vente</span>
                        <span class="col-12 col-lg-3" id="CB">VISA</span>
                        <span class="col-12 col-lg-3" id="numcarte">N° Carte</span>
                        <span class="col-12 col-lg-5" id="numcarte">Montant</span>
                        <span class="col-12 col-lg-1" id="numcarte">EUR</span>
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