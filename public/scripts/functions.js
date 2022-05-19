// GERER L AFFICHAGE DES POURCENTAGES DE DOSSIER COMPLETER
let percentDoc2 = document.querySelectorAll('.percent_doc2')

percentDoc2.forEach(element => {
    let percent = element.getAttribute('data-percent')
    element.style.strokeDashoffset = 'calc(149 - (149 *'+ percent+') / 100)';
    if(percent == 100)
    {
        element.style.stroke = 'green'
    }
});

// _____________________________________________________________

// Gestion des filtres du tableau

let inpFilter = document.querySelector('#inpFilter')
let myInput = document.querySelector('#myInput')

let training = document.querySelector('#filter2')
let statut = document.querySelector('#filter2bis')

training.style.display = "none"
statut.style.display = "none"



let filter1 = document.querySelector('#filter1')

filter1.addEventListener('change', function(){
    let val = filter1.value
    if(val == 'Formation')
    {
        training.style.display = "block"
        statut.style.display = "none"
    }
    else if(val == 'Statut')
    {
        statut.style.display = "block"
        training.style.display = "none"
    }
    else
    {
        training.style.display = "none"
        statut.style.display = "none"
       
    }
})