<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/home.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container container-home d-flex justify-content-center align-items-center">
        <div class="col-12 text-center p-5">
            <img class="p-2 img-fluid" src="assets/img/logo.png" alt="Logo Pimp My Paids" title="Logo Pimp My Paids"/>
            <p class="fs-4 p-0 p-md-5">PimpMyPaid un portail Web spécialisé pour permettre aux clients, qu'ils soient des entreprises ou des commerçants, de consulter leurs comptes et de suivre leurs transactions financières quotidiennes.</p>
            <button class="btn rounded p-3" type="button" onclick="window.location.href='login.php'">Se connecter</button>
        </div>
    </div>

    <?php include('./footer.php'); ?>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>