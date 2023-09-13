import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    connect() {
        const audio = new Audio('/build/sounds/menu-selection-102220.mp3');
        const rollover = this.debounce(() => {
            let resp = audio.play();

            if (resp!== undefined) {
                resp.then(_ => {
                    // autoplay starts!
                }).catch(error => {
                    //show error
                });
            }
        },150);

        document.querySelectorAll('button, a').forEach((element) => {
            element.addEventListener('mouseover',() => {
                rollover()
            })
        })

        let navLinks = document.querySelectorAll('.nav-link')
        navLinks.forEach((element) => {
            element.addEventListener('click', (event) => {
                navLinks.forEach((navLink) => {
                    navLink.classList.remove('active')
                })
                event.target.classList.add('active')
            })
        })
    }

    debounce(cb, delay) {
        let timeout

        return (...args) => {
            clearTimeout(timeout)
            timeout = setTimeout(() => {
                cb(...args)
            }, delay)
        }
    }
}
