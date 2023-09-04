import './styles/app.scss';
require ('@fortawesome/fontawesome-free/css/all.min.css');

window.addEventListener("scroll", function(){
    var navbar = document.querySelector('nav');
    navbar.classList.toggle("sticky", window.scrollY > 0)
})