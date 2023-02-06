import './bootstrap';
import '../../resources/sass/app.scss'


/**
 * Modal
 */
let modal = null

const openModal = async (e) => {
    e.preventDefault()
    const data = JSON.parse(e.target.getAttribute('data-tube'))
    const modalMessage = e.target.getAttribute('data-message')
    const yesResponseURL = `${e.target.getAttribute('data-payload')}${data.slug}`
    modal = document.querySelector('.modal')
    modal.style.display = null
    modal.removeAttribute('aria-hidden')
    modal.setAttribute('aria-modal', true)
    modal.addEventListener('click', closeModal)
    modal.querySelector('.js-modal-text').innerText = modalMessage
    modal.querySelector('.js-modal-yes').setAttribute('href', yesResponseURL)
    modal.querySelector('.js-modal-stop')?.addEventListener('click', stopPropagation)
}

const closeModal = (e) => {
    if (modal === null) return
    e.preventDefault()
    modal.setAttribute('aria-hidden', 'true')
    modal.removeAttribute('aria-modal')
    modal.removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop')?.removeEventListener('click', stopPropagation)
    const hideModal = () => {
        modal.style.display = "none"
        modal.removeEventListener('animationend', hideModal)
        modal = null
    }
    modal.addEventListener('animationend', hideModal)
}

document.querySelectorAll('.js-delete-tube').forEach((element) => element.addEventListener('click', openModal))
document.querySelectorAll('.js-modal-close').forEach((element) => element.addEventListener('click', closeModal))

window.addEventListener('keydown', (e) => {
    if (e.key === "Escape" || e.key === "Esc") closeModal(e)
})

const stopPropagation = (e) => {
    e.stopPropagation()
}


/**
 * Close Notification
 */
document.querySelectorAll('.js-close-popup').forEach((element) => {
    element.addEventListener('click', (e) => e.target.parentNode.remove())
})