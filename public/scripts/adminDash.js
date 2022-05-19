let btnGestionTrainingDoc = document.querySelector('#editDoc');
let IdbtnGestionTrainingDoc = document.querySelector('#IdeditDoc');
let DocName = document.querySelectorAll('.DocName')

let btn_edit= document.querySelector('#Lab_submit')
let btn_add= document.querySelector('#Lab_submit_add')
let btn_cancel= document.querySelector('#Lab_cancel')

btn_cancel.addEventListener('click', function(){
    btnGestionTrainingDoc.value = ''
    IdbtnGestionTrainingDoc.value = ''
    btn_add.removeAttribute('class', 'hiddenbtn')
    btn_edit.setAttribute('class', 'hiddenbtn')
})


DocName.forEach(element => {
    element.addEventListener('click', function(){
        btnGestionTrainingDoc.value = ''
        IdbtnGestionTrainingDoc.value = ''
        console.log('del')
        let id = element.getAttribute("data-id")
        let Name = element.parentNode.parentNode.parentNode.firstChild.textContent
        console.log(Name)
        btnGestionTrainingDoc.value = Name
        IdbtnGestionTrainingDoc.value = id
        btn_add.setAttribute('class', 'hiddenbtn')
        btn_edit.removeAttribute('class', 'hiddenbtn')
        
    })
});





