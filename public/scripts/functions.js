let percentDoc2 = document.querySelectorAll('.percent_doc2')

percentDoc2.forEach(element => {
    let percent = element.getAttribute('data-percent')
    element.style.strokeDashoffset = 'calc(149 - (149 *'+ percent+') / 100)';
    if(percent == 100)
    {
        element.style.stroke = 'green'
    }
});
