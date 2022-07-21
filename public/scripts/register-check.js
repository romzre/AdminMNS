
let inpEmail = document.querySelector('#email')

let alertEmail = document.querySelector('.registration-check')

alertEmail.style.display="none"

inpEmail.addEventListener('blur', function(e){
    let email=this.value
    console.log(email)
    const emailCheck = fetch(`/?area=home&controller=home&action=checkEmailAddress&email=${email}`)
        .then(response => {
        return response.json()
        })
        .then((data) => {
            console.log(data);
            let emailStatus = data.isExistant ;
            if(emailStatus==true) {
                    alertEmail.style.display="inline"
                }
            })
        }
)