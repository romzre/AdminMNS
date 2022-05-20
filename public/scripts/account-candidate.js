let allImg = document.querySelectorAll("form.form-change-password img")
let allSpan = document.querySelectorAll("form.form-change-password span")

let mdpVerif = false

let btn = document.querySelector("button.btn-change-password")

allImg.forEach(element => {
    element.style.display='none'
});

allSpan.forEach(element => {
    element.style.display='none' 
});

//mot de passe 

let inpMdp = document.querySelector('#floatingNewPassword')


let faible = document.querySelector('.l1')
let moyen= document.querySelector('.l2')
let fort = document.querySelector('.l3')

inpMdp.addEventListener('input', function(e){
    let mdpCheck = []
    let coeffmdp = 0 

    // lettre minuscule
    let alphabet = /[a-z]/
    let numeric = /[0-9]/
    let specialChar = /[^a-zA-Z0-9]/ //^=tout sauf

    if(e.target.value.length >= 8){
        coeffmdp += 1
        mdpCheck.push('length')
    }

    if (alphabet.test(e.target.value)) {
        coeffmdp += 1
        mdpCheck.push('alphabet')
    }
    if (numeric.test(e.target.value)) {
        coeffmdp += 1
        mdpCheck.push('numeric')
    }
    if (specialChar.test(e.target.value)) {
        coeffmdp += 1
        mdpCheck.push('specialChar')
    }

    if (coeffmdp == 0) {
        // faible.style.display='inline'
        allImg[0].style.display='inline'
        allImg[0].src = "images/error.svg"
        allSpan[0].style.display='inline'
    }

    if (coeffmdp ==1) {
        faible.style.display='inline'
        allImg[0].style.display='inline'
        allImg[0].src = "images/error.svg"
        allSpan[0].style.display='inline'
    }
    if (coeffmdp==2) {
        faible.style.display='inline'
        allImg[0].style.display='inline'
        allImg[0].src = "images/error.svg"
        allSpan[0].style.display='inline'
        moyen.style.display="none"
        fort.style.display="none"
    }
    if (coeffmdp ==3) {
        moyen.style.display='inline'
        allImg[0].style.display='inline'
        allImg[0].src = "images/error.svg"
        allSpan[0].style.display='inline'
        faible.style.display='inline'
        fort.style.display="none"
    }
    if (coeffmdp ==4) {
        fort.style.display='inline'
        allImg[0].style.display='inline'
        allImg[0].src = "images/check.svg"
        allSpan[0].style.display='none'
        moyen.style.display='inline'
        faible.style.display='inline'
        emailVerif = true
    }
    isValid()
})

//Vérification du mdp 
let mdpConf = document.querySelector('#floatingConfirmPassword')

mdpConf.addEventListener('input', function(e){

    if(e.target.value ===inpMdp.value) {
        allImg[1].src = "images/check.svg"
        allImg[1].style.display='inline'
        allSpan[1].style.display='none'
        mdpVerif = true
    }
    else {
        allImg[1].src = "images/error.svg"
        allImg[1].style.display='inline'
        allSpan[1].style.display='inline'
        mdpVerif = false
    }
    isValid()
})

function isValid(){
    if(mdpVerif === true) 
    {
        btn.disabled = false
    } 
    else 
    {
        btn.setAttribute('disabled', 'true')
    }
}

let formChangePic = document.querySelector('.form-change-pic')

let inputPic = document.querySelector('#edit-profile_pic')

inputPic.addEventListener("input", function(e){
    formChangePic.submit()
})