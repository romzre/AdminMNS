let allImg = document.querySelectorAll("img")
let span = document.querySelector("span")

let emailVerif = false
let mdpVerif = false



// écouter un évenement sur le mail et vérifier avec une expression régulière
let inpEmail = document.querySelector('#email_input')
let expressionReguliere = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
let regEx = /\S+@\S+\.\S+/ //expression regulière du prof

inpEmail.addEventListener('input', function(e){
    if(expressionReguliere.test(e.target.value)) {
        allImg[1].style.display='inline'
        allImg[1].src = "images/check.svg"
        span.style.display='none'
        emailVerif = true

    } else {
        allImg[1].style.display='inline'
        allImg[1].src = "images/error.svg"
        span.style.display='inline'
        emailVerif = false
    }

})
