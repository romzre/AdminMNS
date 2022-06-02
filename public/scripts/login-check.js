let img = document.querySelector("img")
let span = document.querySelector("span")

let emailVerif = false
let mdpVerif = false



// écouter un évenement sur le mail et vérifier avec une expression régulière
let inpEmail = document.querySelector("input[type='email']")
let expressionReguliere = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;


inpEmail.addEventListener('input', function(e){
    if(expressionReguliere.test(e.target.value)) {
        img.style.display='inline'
        img.src = "images/check.svg"
        span.style.display='none'
        emailVerif = true

    } else {
        img.style.display='inline'
        img.src = "images/error.svg"
        span.style.display='inline'
        emailVerif = false
    }

})


