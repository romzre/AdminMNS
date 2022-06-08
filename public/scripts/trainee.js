let fileInputs = document.querySelectorAll("input[type=file]")
let bigForm = document.querySelector('.form-justify-abs')
let btnSendFile = document.querySelector("button[name=form-button-abs]")



//on cache le bouton envoyer tant qu'aucun document n'a été sélectionné
btnSendFile.style.display="none"
btnSendFile.addEventListener('click', function(e){
    e.preventDefault();
    bigForm.submit()

})

// permet de mettre le nom du fichier sélectionné dans la case du type de docs : 
fileInputs.forEach(element => {
    
    element.addEventListener('change', function(e){
    
        let nameFile=e.target.value;
        let pathFile= document.createElement('div');
        pathFile.setAttribute('class','path')
        pathFile.textContent=nameFile

        let parent = element.parentNode
        parent.appendChild(pathFile)
        btnSendFile.style.display="inline"
        
    })
    
});

// on ajoute l'attriut form-data au formulaire si son input file a été modifié
fileInputs.forEach(input=> {
    input.addEventListener('change', function (e){
        let nameClass = input.getAttribute('class')
        console.log(nameClass)
        let absForms = document.querySelectorAll(`.${nameClass}`)
        console.log(absForms)
        absForms.forEach(form => { form.setAttribute('data-info', 'toSend')})
    
    })
})
