// --------------GESTION DES BOUTONS ACTION DANS DOCUMENT ------------------------

let Labjustify_text = document.querySelector('#Lab_justify_text')
let Lab_cancelDoc = document.querySelector('#Lab_cancelDoc')
let inpJustify_text = document.querySelector('#inpJustify_text')
let returnbtn = document.querySelector('#returnbtn')
let acceptbtn = document.querySelector('#acceptbtn')

Labjustify_text.addEventListener('click', function(){
    inpJustify_text.style.display = "block"
    Labjustify_text.style.display = "none"
    acceptbtn.style.display = "none"
    Lab_cancelDoc.style.display = "block"
    returnbtn.style.display = "block"
})

returnbtn.addEventListener('click', function(){
    inpJustify_text.style.display = "none"
    Labjustify_text.style.display = "block"
    acceptbtn.style.display = "block"
    Lab_cancelDoc.style.display = "none"
    returnbtn.style.display = "none"

})