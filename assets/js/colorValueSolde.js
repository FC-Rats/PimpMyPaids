var soldeElement = document.getElementById("solde");
var remittanceElement = document.getElementById("remittance");
var unpaidsElement = document.getElementById("unpaids");
var solde = parseFloat(soldeElement.textContent);
var remittance = parseFloat(remittanceElement.textContent);
var unpaids = parseFloat(unpaidsElement.textContent);
if (solde < 0) {
  soldeElement.style.color = "#AE2A00";
}
if (remittance < 0) {
  remittanceElement.style.color = "#AE2A00";
}
if (unpaids < 0) {
  unpaidsElement.style.color = "#AE2A00";
}