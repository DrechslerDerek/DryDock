import {Controller} from '@hotwired/stimulus';

/**
 * @property {String} userEmailValue
 */
export default class extends Controller {

    static targets = [
    ]

    static values = {
        userEmail: String
    }


   connect() {
   }

   deleteAlert(event){
       document.querySelector('#alertCount').innerText = Number(document.querySelector('#alertCount').innerText) - 1;
       event.target.parentNode.remove();
   }
}