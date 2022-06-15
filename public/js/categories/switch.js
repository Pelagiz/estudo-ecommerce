var categories = document.querySelector('header .container .categories');
var container = document.querySelector('header .container .categories .container');

const categoryOn = (e) => {
    container.classList.remove('hide');
}

const categoryOff = (e) => {
        container.classList.add('hide');
}

categories.addEventListener('mouseenter', categoryOn );

categories.addEventListener('mouseleave', categoryOff);