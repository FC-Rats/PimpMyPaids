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
                <form class="d-flex align-items-center justify-content-around" id="formPoUnpaids">
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="siren" name="siren" placeholder=" ">
                        <label for="siren">N° SIREN</label>
                    </div>
                    <div class="form-floating text-dark col-12 col-sm-5 m-1">
                        <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" placeholder=" ">
                        <label for="raisonSociale">Raison Sociale</label>
                    </div>
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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDetailUnpaidClient" aria-labelledby="offcanvasDetailUnpaidClientLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasDetailUnpaidClientLabel">Impayés de Nom entreprise</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
                <div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                    <span class="col-6" id="numSiren">N° SIREN</span>
                    <span class="col-6" id="dateVente">Date vente</span>
                    <span class="col-6" id="dateRemise">Date remise</span>
                    <span class="col-6" id="reseau">Reseau</span>
                    <span class="col-6" id="numCarte">N° carte</span>
                    <span class="col-6" id="numDossier">N° dossier impayé</span>
                    <span class="col-6" id="sens">-</span>
                    <span class="col-6" id="montant">Montant</span>
                    <span class="col-6" id="devise">Devise</span>
                    <span class="col-6" id="libelle">Libellé</span>
                </div>
            </div>
        </div>
        <div class="headquery d-flex align-items-center justify-content-start mt-5 border-bottom border-black">
            <span>X résultats - Somme des impayés par Raison Sociale</span>
        </div>
        <div class="container-unpaid-list">
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numSiren">N° SIREN</span>
                <span class="col-12 col-sm-6 col-lg-3" id="dateVente">Raison sociale</span>
                <div class="d-flex flex-row justify-content-start justify-content-lg-center align-items-center col-12 col-sm-6 col-lg-4">
                    <span class="col-1" id="dateRemise">-</span>
                    <span class="col-auto me-2 me-lg-0 col-lg-4" id="montant">Somme</span>
                    <span class="col-3 col-lg-2" id="devise">Devise</span>
                </div>
                <div class="d-flex justify-content-start justify-content-lg-end align-items-center col-12 col-sm-6 col-lg-2">
                    <button class="btn btn-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailUnpaidClient" aria-controls="offcanvasDetailUnpaidClient">Détail</button>
                </div>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numSiren">N° SIREN</span>
                <span class="col-12 col-sm-6 col-lg-3" id="dateVente">Raison sociale</span>
                <div class="d-flex flex-row justify-content-start justify-content-lg-center align-items-center col-12 col-sm-6 col-lg-4">
                    <span class="col-1" id="dateRemise">-</span>
                    <span class="col-auto me-2 me-lg-0 col-lg-4" id="montant">Somme</span>
                    <span class="col-3 col-lg-2" id="devise">Devise</span>
                </div>
                <div class="d-flex justify-content-start justify-content-lg-end align-items-center col-12 col-sm-6 col-lg-2">
                    <button class="btn btn-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailUnpaidClient" aria-controls="offcanvasDetailUnpaidClient">Détail</button>
                </div>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numSiren">N° SIREN</span>
                <span class="col-12 col-sm-6 col-lg-3" id="dateVente">Raison sociale</span>
                <div class="d-flex flex-row justify-content-start justify-content-lg-center align-items-center col-12 col-sm-6 col-lg-4">
                    <span class="col-1" id="dateRemise">-</span>
                    <span class="col-auto me-2 me-lg-0 col-lg-4" id="montant">Somme</span>
                    <span class="col-3 col-lg-2" id="devise">Devise</span>
                </div>
                <div class="d-flex justify-content-start justify-content-lg-end align-items-center col-12 col-sm-6 col-lg-2">
                    <button class="btn btn-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailUnpaidClient" aria-controls="offcanvasDetailUnpaidClient">Détail</button>
                </div>
            </div>
            <div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="">
                <span class="col-12 col-sm-6 col-lg-1" id="numSiren">N° SIREN</span>
                <span class="col-12 col-sm-6 col-lg-3" id="dateVente">Raison sociale</span>
                <div class="d-flex flex-row justify-content-start justify-content-lg-center align-items-center col-12 col-sm-6 col-lg-4">
                    <span class="col-1" id="dateRemise">-</span>
                    <span class="col-auto me-2 me-lg-0 col-lg-4" id="montant">Somme</span>
                    <span class="col-3 col-lg-2" id="devise">Devise</span>
                </div>
                <div class="d-flex justify-content-start justify-content-lg-end align-items-center col-12 col-sm-6 col-lg-2">
                    <button class="btn btn-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailUnpaidClient" aria-controls="offcanvasDetailUnpaidClient">Détail</button>
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
    <script src="assets/js/poUnpaidsChart.js"></script>
</body>

</html>