import { Controller } from '@hotwired/stimulus';

/**
 * @property {HTMLElement} drawerElementTarget
 * @property {String} userEmailValue
 */
export default class extends Controller {

    static targets = [
        'drawerElement'
    ]

    static values = {
        userEmail: String
    }

   connect() {
       let email = this.userEmailValue;
       let socket = new WebSocket("ws://localhost:8080");
       socket.onopen = function (event) {
           socket.send(email);
       }

       let drawer = this.drawerElementTarget;
       socket.onmessage = function (event) {
           let partEvent = JSON.parse(event.data);
            console.log(partEvent)
           if(typeof partEvent.part_name !== 'undefined'){
               let temp = document.getElementById('alertTemplate');

               temp.content.querySelector('#partName').innerText = partEvent.part_name;
               temp.content.querySelector('#partCreatedName').innerText = partEvent.creator;
               temp.content.querySelector('#partCreatedTime').innerText = partEvent.created_time;

               let alert = temp.content.cloneNode(true);
               drawer.append(alert);
           }
       }
   }

   deleteAlert(event){
        event.target.parentNode.remove();
   }
}