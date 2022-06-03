let streetNumber = document.querySelector('#streetNumber');
let laneType = document.querySelector('#laneType');
let street = document.querySelector('#street');
let postalCode = document.querySelector('#postalCode');
let city = document.querySelector('#city');
let addressComplement = document.querySelector('#addressComplement');
let contAuto = document.querySelector('.contAutoComplete')
let champ1 = ""
let champ2 = ""
let champ3 = ""

streetNumber.addEventListener('blur', function(){

    champ1 = this.value

})

laneType.addEventListener('blur', function(){

    champ2 = this.value


})

street.addEventListener('input', function(){
    let arrayAddress = []
    contAuto.innerHTML = ""
    champ3 = this.value
    console.log(champ1+" "+champ2+" "+champ3)
    if(champ3 != "")
    {
        const Address = fetch("https://api-adresse.data.gouv.fr/search/?q="+champ1+" "+champ2+" "+champ3+"&limit=5")
    .then(response => {
        return response.json()
    }).then((data) => {
        
        for (let i = 0; i < 5; i++) {
            arrayAddress.push(data.features[i].properties.label)
        }
        
        arrayAddress.forEach(element => {
            let option = document.createElement('option');
            option.innerText = element
            option.setAttribute('class', '')
            contAuto.appendChild(option);
        });
        let parent = postalCode.parentNode
        // parent.appendChild(contAuto)
        // postalCode.parentNode.insertBefore(contOptions,postalCode.nextSibling)
      console.log(arrayAddress)  
    })
    }
    
})

