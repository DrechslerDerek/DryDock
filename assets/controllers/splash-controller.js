import { Controller } from '@hotwired/stimulus';

/**
 * @property {HTMLElement} splashDivTarget
 * @property {HTMLElement} blastoffTarget
 * @property {HTMLElement} splashContentTarget
 * @property {HTMLElement} loginFormTarget
 */
export default class extends Controller {

    static targets = [
        'splashDiv',
        'blastoff',
        'splashContent',
        'loginForm',
    ]
    connect() {

    }

    showSplash(event){
        event.target.classList.add('d-none')
        this.splashDivTarget.classList.remove('d-none')
        this.play()
    }

    play(){
        const audio = new Audio('/build/sounds/Mass-Effect-Trilogy-Extended-Gal.mp3');
        // audio.loop = true;
        let resp = audio.play();

        if (resp !== undefined) {
            resp.then(_ => {

                // autoplay starts!
            }).catch(error => {console.log(error)
                //show error
            });
        }
    }

    formSubmit(event){
        if(
            document.querySelector('#registration_captain').value.length > 0 &&
            document.querySelector('#registration_password').value.length > 0 &&
            document.querySelector('#registration_email').value.length > 0
        ){
            event.target.classList.add('disabled')
            event.target.innerHTML = '<div class="spinner-grow text-light spinner-grow-sm" role="status"></div> Registering...'
        }
    }

    sendEmail(event) {
        if(document.querySelector('#reset_password_email').value.length > 0){
            event.target.classList.add('disabled')
            event.target.innerHTML = '<div class="spinner-grow text-light spinner-grow-sm" role="status"></div> Sending...'
        }
    }
}
