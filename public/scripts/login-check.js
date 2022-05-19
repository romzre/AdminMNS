let img = document.querySelector("img")
let span = document.querySelector("span")

let emailVerif = false
let mdpVerif = false



// écouter un évenement sur le mail et vérifier avec une expression régulière
let inpEmail = document.querySelectorAll("input[type='password']")


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
