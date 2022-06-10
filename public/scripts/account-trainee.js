let allImg = document.querySelectorAll("img.icone-verif-js")
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
let buttonFormPic = document.querySelector('.btn-hidden')

let inputPic = document.querySelector('#edit-profile_pic')

inputPic.addEventListener("change", function(e){
    if(e.target.value !== null)
    {
        buttonFormPic.click()      
    }
   
})


// 

let allInputsChangeInfos = document.querySelectorAll('#form_full-screen input');
let allInputsChangeInfosMobile = document.querySelectorAll('#form_mobile input');

allInputsChangeInfos.forEach(input => { input.setAttribute('disabled', true)})
allInputsChangeInfosMobile.forEach(input => { input.setAttribute('disabled', true)})

let btnChangeInfo = document.querySelector('#btn-change-personal-info')
let btnChangeInfoMobile = document.querySelector('#btn-change-personal-info_mobile')

let btnValidateInfo = document.querySelector('#btn-validate-personal-info')
let btnValidateInfoMobile = document.querySelector('#btn-validate-personal-info_mobile')

btnValidateInfo.style.display="none"
btnValidateInfoMobile.style.display="none"

function personalInfoFormAvailable (buttonChange, buttonValidate, inputs)
{

    buttonChange.addEventListener('click', function(e){
        e.preventDefault()
        
        inputs.forEach(input => { 
            console.log()
            input.removeAttribute('disabled')
            this.style.display='none'
            buttonValidate.style.display="inline"
            })
            
        });
}

personalInfoFormAvailable(btnChangeInfo, btnValidateInfo, allInputsChangeInfos);
personalInfoFormAvailable(btnChangeInfoMobile, btnValidateInfoMobile, allInputsChangeInfosMobile);

// btnChangeInfo.addEventListener('click', function(e){
//     e.preventDefault()
    
//     allInputsChangeInfos.forEach(input => { input.removeAttribute('disabled')
//                                             this.style.display='none'
//                                             btnValidateInfo.style.display="inline"})
        
//     });



// btnChangeInfoMobile.addEventListener('click', function(e){
//     e.preventDefault()
    
//     allInputsChangeInfosMobile.forEach(input => { input.removeAttribute('disabled')
//                                             this.style.display='none'
//                                             btnValidateInfoMobile.style.display="inline"})
        
//     });
    