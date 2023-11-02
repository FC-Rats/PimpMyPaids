/* Constantes pr JS */
const ajoutBtn = document.getElementById('ajout-btn');
const suppressionBtn = document.getElementById('suppression-btn');
const ajoutForm = document.getElementById('ajout-form');
const suppressionForm = document.getElementById('suppression-form');
const formulaire = document.getElementById('formulaire');

/* Si on change alors*/
ajoutBtn.addEventListener('click', function() {
    ajoutForm.style.display = 'block';
    suppressionForm.style.display = 'none';

    formulaire.style.backgroundColor = "#FFC65C";

    ajoutBtn.classList.add('active');
    suppressionBtn.classList.remove('active');
});

suppressionBtn.addEventListener('click', function() {
    ajoutForm.style.display = 'none';
    suppressionForm.style.display = 'block';

    formulaire.style.backgroundColor = "#009CB0";

    suppressionBtn.classList.add('active');
    ajoutBtn.classList.remove('active');
});
