let navAccount = document.querySelector(".navbar-account")
let navImgAccount = document.querySelector(".nav-img-account")
let navAccountContent = document.querySelector(".navbar-account--toggle")


let accountActive = false

navImgAccount.addEventListener('click', function () {
    navAccountContent.classList.toggle('is-active');
    
})


function accountImg(){

    if(navAccountContent.classList.contains('is-active')){
        navImgAccount.src="images/account-hover.png"
        accountActive=true
    }
    else {
            accountActive=false
        }

}

navAccount.addEventListener('mouseover', function(e){
    navImgAccount.src="images/account-hover.png"
})

navAccount.addEventListener('mouseleave', function(e){
    if(!accountActive){
    navImgAccount.src="images/account-img.png"
    }
})


var intervalImgAccount = setInterval(accountImg, 500);

let navBurger = document.querySelector('.nav__burger')
let navBar = document.querySelector('.navbar')


navBurger.addEventListener('click',function(){
    navBar.classList.toggle('show-nav')
    console.log('ok')
})