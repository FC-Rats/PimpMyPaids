<?php
$tab = [];
$tab["siren"] = $_POST["siren"];
$tab["companyName"] = $_POST["companyName"];
$tab["beforeDate"] = $_POST["beforeDate"];
$tab["afterDate"] = $_POST["afterDate"];
$tab["label"] = $_POST["label"];
$tab["idUnpaid"] = $_POST["idUnpaid"];
$resp["ListUnpaids"] = $tab;
echo json_encode($resp);