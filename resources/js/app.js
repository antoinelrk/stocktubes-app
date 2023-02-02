import './bootstrap';
import '../../resources/sass/app.scss'


document.querySelectorAll('.js-close-popup').forEach((element) => {
    element.addEventListener('click', (e) => e.target.parentNode.remove())
})