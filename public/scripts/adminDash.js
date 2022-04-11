let btn = document.querySelectorAll('.btn');

btn.forEach(element => {
    element.addEventListener('click', () => {
        console.log('ok')
    })
});