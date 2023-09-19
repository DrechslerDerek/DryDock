import { Controller } from '@hotwired/stimulus';

/**
 * @property {HTMLElement} blastoffTarget
 */
export default class extends Controller {

    static targets = [
        'blastoff'
    ]

    connect() {
        Turbo.setProgressBarDelay(5000)

        document.querySelector('#splashHeading').classList.add('d-none')
        document.querySelector('#nav-tab').classList.add('d-none')
        this.blastoffTarget.classList.remove('d-none');
        this.sleep(3500).then(() => {
            Turbo.visit('/main', { action: 'advance'})
        })
    }

    sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}
