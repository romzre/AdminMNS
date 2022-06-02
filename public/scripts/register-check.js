
let inpEmail = document.querySelector('#email')

let alertEmail = document.querySelector('.registration-check')

alertEmail.style.display="none"

inpEmail.addEventListener('blur', function(e){
    let email=this.value
    console.log(email)
    const emailCheck = fetch(`check-email-addresses.php/?email=${email}`)
        .then(response => {
                return response.json()
        }).then((data) => {
            let emailStatus = data.isExistant ;
            if(emailStatus==true) {
                    alertEmail.style.display="inline"
                }
            })
}
)