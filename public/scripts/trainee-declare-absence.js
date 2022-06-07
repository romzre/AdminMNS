let inputFile = document.querySelector('.form-input')
let alerteDate = document.querySelector('.alert-date')

alerteDate.style.display="none"

inputFile.style.display="none"

let checkBox = document.querySelector('.form-check-input')

checkBox.addEventListener('change', function(){

    if(this.checked){

        inputFile.style.display="inline"
    }
    else inputFile.style.display="none"
    }
)

let startingDateInput = document.querySelector('input[name="startingDate_absence"]')
let endDateInput = document.querySelector('input[name="endDate_absence"]')

let startingDateEntered 
let endDateEntered 

startingDateInput.addEventListener('change', function(e){
    let input = this.value
    startingDateEntered = new Date(input);
    checkDateDiff()
})

endDateInput.addEventListener('change', function(e){
    let input = this.value
    endDateEntered = new Date(input);
    checkDateDiff()
})

function checkDateDiff()
{
    if(typeof endDateEntered != 'undefined'  && typeof startingDateEntered !='undefined'){
        diff= endDateEntered-startingDateEntered
        if (diff<=0) {
            alerteDate.style.display="inline"
        }
    }
}
