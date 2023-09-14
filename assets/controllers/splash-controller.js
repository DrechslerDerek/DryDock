import { Controller } from '@hotwired/stimulus';

/**
 * @property {HTMLElement} splashDivTarget
 */
export default class extends Controller {

    static targets = [
        'splashDiv'
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
}
