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

    login() {
        this.loginFormTarget.submit()
        // this.loginRocketAnimation();
        // setTimeout(this.loginRocketAnimation,5000)
        // this.loginFormTarget.submit()
    }

    loginRocketAnimation(){
        this.blastoffTarget.classList.add('fade-in')
        this.blastoffTarget.classList.remove('d-none')
        this.splashContentTarget.classList.add('d-none')
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
        event.target.classList.add('disabled')
        event.target.innerHTML = '<div class="spinner-grow text-light" role="status"></div> Registering'
    }
}
