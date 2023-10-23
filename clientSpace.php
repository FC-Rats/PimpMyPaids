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
  <?php include('./header.php'); ?>

  <div class="container espace-client-section">
    <div class="row container-cols-espace-client">
      <div class="col-6 d-flex flex-column justify-content-center align-items-center pt-4">
        <div>
          <div class="pb-5">
            <h2>Content de vous revoir parmi nous, </h2>
            <h1>NOM Prénom</h1>
          </div>
          <div class="rounded p-3 bg-grey fs-4 d-flex align-items-center justify-content-center text-center col-12">
            <span class="col-4">Votre solde : </span><span class="fw-bold col-3" id="solde">-10000,00</span><span class="col-1²" id="devise"> EUR</span><i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-4"></i>
          </div>

          <div class="align-items-center justify-content-center text-center pt-5">
            <img class="p-2 img-fluid" src="assets/img/profile.svg" alt="Profil de compte" title="Profil de compte" />
          </div>
        </div>
      </div>
      <div class="col-6 d-flex flex-column align-items-center justify-content-center h-100 pt-4">
        <p class="text-center">Espace Client</p>
      </div>
    </div>
  </div>


  <?php include('./footer.php'); ?>
  <script src="assets/js/color-value-solde.js"></script>
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!-- JQuery -->
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <!-- HighCharts JS -->
  <script src="assets/js/highcharts.js"></script>
</body>

</html>