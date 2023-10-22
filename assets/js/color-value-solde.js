var soldeElement = document.getElementById("solde");
var solde = parseFloat(soldeElement.textContent);
if (solde < 0) {
  soldeElement.style.color = "#AE2A00";
}
