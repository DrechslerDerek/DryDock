import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    connect() {
        document.querySelectorAll('button, a').forEach((element) => {
            element.addEventListener('mouseover',() => {
                let audio = new Audio('/build/sounds/menu-selection-102220.mp3');
                let resp = audio.play();

                if (resp!== undefined) {
                    resp.then(_ => {
                        // autoplay starts!
                    }).catch(error => {
                        //show error
                    });
                }
            })
        })
    }
}
