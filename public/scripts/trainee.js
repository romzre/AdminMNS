let inputs = document.querySelectorAll("input[type=file]")
let btnSendFile = document.querySelector("button[name=form-button-abs]")

let allBtnFormMotif= document.querySelectorAll("button.btn-form-motif")

allBtnFormMotif.forEach(btn => btn.style.display="none")

btnSendFile.style.display="none"

// permet de mettre le nom du fichier sélectionner dans la case du type de docs : 
inputs.forEach(element => {
    
    element.addEventListener('change', function(e){
        console.log(element)
    
        let nameFile=e.target.value;
        let pathFile= document.createElement('div');
        pathFile.setAttribute('class','path')
        pathFile.textContent=nameFile

        let parent = element.parentNode
        parent.appendChild(pathFile)
        btnSendFile.style.display="inline"
        
    })
    
});