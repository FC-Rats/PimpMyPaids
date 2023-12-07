<?php if (!isset($_SESSION)) {
    session_start();
} 
if (!class_exists('Connection')) {
    include('./includes/connectionFunctions.php');
}
include('./includes/usefulFonctions.php');
$names = $db->query('SELECT firstName, lastName FROM TRAN_USERS WHERE idUser = :idUser', array(array(':idUser', $_SESSION['id'])));

$allDataClient = "SELECT 
(SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T WHERE T.siren = :siren) AS totalAmount,
(SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND T.siren = :siren) AS sumRemises,
(SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransac = U.idTransac WHERE T.siren = :siren) AS sumImpayes,
(SELECT currency FROM TRAN_CUSTOMER_ACCOUNT WHERE siren = :siren) AS currency;";        
$conditions = array(array(":siren", $_SESSION["siren"]));
$datas = $db->query($allDataClient, $conditions);
?>
<!DOCTYPE html>
<html lang="fr">

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
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>
    <!-- getEspaceData() -->
    <div class="container espace-client-section">
        <div class="row container-cols-espace-client">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pt-4">
                <div>
                    <div class="pb-5">
                        <h2>Content de vous revoir parmi nous,</h2>
                        <h1><span id="clientName"><?php echo $names[0]['lastName'];?></span> <span id="clientFirstName"><?php echo $names[0]['firstName'];?></span></h1>
                    </div>
                    <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12">
                        <span class="col-4">Votre solde :</span>
                        <span class="fw-bold col-4" id="clientBalance"><?php echo $datas[0]["totalAmount"];?></span>
                        <span class="col-1 clientCurrency"><?php echo $datas[0]["currency"];?></span>
                        <i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-3"></i>
                    </div>
                    <div class="align-items-center justify-content-center text-center pt-5 d-none d-sm-block">
                        <img class="p-2 img-fluid" src="assets/img/profile.svg" alt="Profil de compte" title="Profil de compte" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center pt-4">
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12">
                    <figure class="highcharts-figure col-12">
                        <div id="container-soldes"></div>
                    </figure>
                </div>
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12 my-2">
                    <span class="col-4">Somme remises :</span>
                    <span class="fw-bold col-4" id="clientRemittances"><?php echo $datas[0]["sumRemises"];?></span>
                    <span class="col-1 clientCurrency"><?php echo $datas[0]["currency"];?></span>
                    <i class="fa-solid fa-money-bill-transfer fa-xl col-3"></i>
                </div>
                <div class="rounded p-3 bg-grey fs-5 d-flex align-items-center justify-content-center text-center col-12 my-2">
                    <span class="col-4">Somme impayés :</span>
                    <span class="fw-bold col-4" id="clientUnpaids"><?php echo $datas[0]["sumImpayes"];?></span>
                    <span class="col-1 clientCurrency"><?php echo $datas[0]["currency"];?></span>
                    <i class="fa-solid fa-file-invoice-dollar fa-xl col-3"></i>
                </div>
                <div class="p-3 fs-5 d-flex align-items-center justify-content-center text-center col-12">
                    <span>Pour apprendre à mieux gérer ses soldes : <a href="https://www.wikihow.com/Improve-Your-Sales" target="_blank" class="text-decoration-none" title="Pour apprendre à mieux gérer ses soldes">cliquez ici</a></span>
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
    <script src="assets/js/clientSpace.js"></script>
</body>

</html>