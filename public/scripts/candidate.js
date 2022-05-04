let inputs = document.querySelectorAll("input")
console.log(inputs)


inputs.forEach(element => {
    
    element.addEventListener('change', function(e){
        console.log(element)
    
        let nameFile=e.target.value;
        let pathFile= document.createElement('div');
        pathFile.setAttribute('class','path')
        pathFile.textContent=nameFile

        let parent = element.parentNode
        let td = parent.previousElementSibling        
        td.appendChild(pathFile)
        
    })
    
});
