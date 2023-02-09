import './bootstrap';
import '../../resources/sass/app.scss'

/**
 * Tubes filter
 */
const filterButtons = document.querySelectorAll('.js-mode-show')
const resetFilterButtons = (clickedButton) => {
    filterButtons.forEach((button) => {
        if (clickedButton !== button) button.classList.remove('active')
    })
}

const tubesData = JSON.parse(document.querySelector('.js-title-tubes').getAttribute('data-tubes'))

let filterRule = `all`
let filteredData = tubesData

filterButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        const clickedButtonElement = e.target
        if (!clickedButtonElement.classList.contains('active')) {
            clickedButtonElement.classList.add('active')
            resetFilterButtons(clickedButtonElement)
            filterRule = e.target.getAttribute('data-filter')
            switch (filterRule) {
                case "all": 
                    filteredData = tubesData
                    break
                case "warning":
                    filteredData = tubesData.filter((tube) => tube.quantity <= tube.warning)
                    break
                case "critical":
                    filteredData = tubesData.filter((tube) => tube.quantity <= tube.critical)
                    break
                default: 
                    filteredData = tubesData
            }
            redrawTable(filteredData)
        }
    })
})


const redrawTable = (filteredData) => {
    let table = document.querySelector('#tubesTable')
    table.innerHTML = ``
    let incrementedLine = ``
    filteredData.forEach((tube) => {
        incrementedLine += `
        <tr class="line" id="line">
            <td class="reference warning"><a href="/tubes/show/${tube.slug}">${tube.reference}</a></td>
            <td class="number ${(tube.quantity <= tube.critical) ? `critical` : (tube.quantity <= tube.warning) ? `warning` : ""}">${tube.quantity}</td>
            <td class="number">${tube.used ?? "Aucun"}</td>
            <td class="number">${tube.unused ?? "Aucun"}</td>
            <td class="action">
                <a href="/tubes/edit/${tube.slug}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 512 512">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </figure>
                </a>
                <a class=" ${!tube.datasheet ? "lock" : ""} target="_blank" href="/storage/datasheets/tubes/${tube.datasheet}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 121 113">
                            <g fill-rule="evenodd" stroke-linejoin="round">
                                <path id="document-file-pdf" d="M79.167 95.833v8.344a8.314 8.314 0 0 1-8.323 8.323H8.323C3.712 112.5 0 108.755 0 104.136V8.364C0 3.743 3.747 0 8.369 0H50v25.008c0 4.631 3.742 8.325 8.358 8.325h20.809v8.334H41.695c-6.919 0-12.528 5.592-12.528 12.495v29.176c0 6.901 5.566 12.495 12.528 12.495h37.472zM54.167 0v24.988c0 2.308 1.879 4.179 4.128 4.179h20.872L54.167 0zM41.644 45.833c-4.59 0-8.311 3.751-8.311 8.3v29.234c0 4.584 3.76 8.3 8.311 8.3h70.879c4.59 0 8.31-3.751 8.31-8.3V54.133c0-4.584-3.759-8.3-8.31-8.3H41.644zm54.189 20.834v-8.334H112.5v-4.166H91.667v29.166h4.166v-12.5h12.5v-4.166h-12.5zM41.667 62.5v20.833h4.166v-12.5h8.313c4.614 0 8.354-3.699 8.354-8.333 0-4.602-3.725-8.333-8.354-8.333H41.667V62.5zm4.166-4.167v8.334h8.338a4.154 4.154 0 0 0 4.162-4.167 4.152 4.152 0 0 0-4.162-4.167h-8.338zm20.834-4.166v29.166h12.479a8.325 8.325 0 0 0 8.354-8.358v-12.45a8.346 8.346 0 0 0-8.354-8.358H66.667zm4.166 4.166v20.834h8.338a4.153 4.153 0 0 0 4.162-4.166V62.499a4.152 4.152 0 0 0-4.162-4.166h-8.338z"></path>
                            </g>
                        </svg>
                    </figure>
                </a>
                <a class="btn-remove-danger js-delete-tube" data-tube="${tube}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 448 512">
                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </figure>
                </a>   
            </td>
        </tr>
        `
    })
    
    const filteredTablePattern = `
    <tr class="title">
        <td class="reference">Reference</td>
        <td class="number">Quantity</td>
        <td class="number">Used</td>
        <td class="number">Unused</td>
        <td class="action">Action</td>
    </tr>
    ${incrementedLine}
    `
    table.innerHTML = filteredTablePattern
}

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