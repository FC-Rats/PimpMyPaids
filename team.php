<?php if (!isset($_SESSION)) {
    session_start();
} 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>A Propos</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="assets/img/logo.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/aboutUs.css" />
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
    <div class="conteuneur container-fluid login-section">
    <h1 class="p-4 text-center">La TEAM</h1>
    <div class="row justify-content-center mb-4">

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15">
        <img src="./assets/img/avatarTran.png" class="card-img-top w-70 h-60 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Louis Tran</h5>
            <p class="card-text text-purple-600">Product Owner</p>
            
            <div class="d-flex justify-content-center mt-2">
            <a href="https://manifesteagile.fr" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15">
        <img src="./assets/img/avatar1.png" class="card-img-top w-80 h-60 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Helena Chevalier</h5>
            <p class="card-text text-purple-600">Scrum Master / Developpeur</p>
            
            <div class="d-flex justify-content-center mt-2">
                <a href="https://www.linkedin.com/in/héléna-chevalier-720085236/" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
                <a href="mailto:lna.chevalier@gmail.com" target="_blank" alt="lien linkedin"><i class="fab fa-regular fa-at fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15">
        <img src="./assets/img/avatar3.png" class="card-img-top w-80 h-60 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Loélia Coutellier</h5>
            <p class="card-text text-purple-600">Tech lead / Developpeuse</p>
            
            <div class="d-flex justify-content-center mt-2">
            <a href="https://www.linkedin.com/in/loélia-coutellier-a13a89257/" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
            <a href="mailto:loelia.coutellier@gmail.com" target="_blank" alt="lien linkedin"><i class="fab fa-regular fa-at fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15">
        <img src="./assets/img/avatar2.png" class="card-img-top w-80 h-60 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Kellian Bredeau</h5>
            <p class="card-text text-purple-600">Lead Dev / Developpeur</p>
            
            <div class="d-flex justify-content-center mt-2">
            <a href="https://www.linkedin.com/in/kellian-bredeau/" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
            <a href="mailto:kellianbre@outlook.fr" target="_blank" alt="lien linkedin"><i class="fab fa-regular fa-at fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15" >
        <img src="./assets/img/avatar3.png" class="card-img-top w-50 h-40 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Chamsedine Amouche</h5>
            <p class="card-text text-purple-600">Developpeur</p>
            
            <div class="d-flex justify-content-center mt-2">
            <a href="https://www.linkedin.com/in/chamsedine-amouche-192022239/" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
            <a href="mailto:amouche.chamsedine@gmail.com" target="_blank" alt="lien linkedin"><i class="fab fa-regular fa-at fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>

    <div class="card col-12 m-1 col-sm-5 col-md-2 w-15">
        <img src="./assets/img/avatar3.png" class="card-img-top w-50 h-40 object-cover transition duration-200 hover:scale-110 mx-auto mt-3" alt="Olivia Rhye">
        <div class="card-body text-center pb-4 ">
            <h5 class="card-title text-dark font-weight-bold">Léo Dessertenne</h5>
            <p class="card-text text-purple-600">Developpeur</p>
            <div class="d-flex justify-content-center mt-2">
            <a href="https://www.linkedin.com/in/leo-dessertenne-3a571425b/" target="_blank" alt="lien linkedin"><i class="fab fa-linkedin fa-lg text-secondary mx-2"></i></a>
            <a href="mailto:leodesse2@gmail.com" target="_blank" alt="lien linkedin"><i class="fab fa-regular fa-at fa-lg text-secondary mx-2"></i></a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php include('./footer.php'); ?>




    </div>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>