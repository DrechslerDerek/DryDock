import { Controller } from '@hotwired/stimulus';
import * as bootstrap from 'bootstrap';

export default class extends Controller {

    connect() {}

    openEdit(event) {
        let partId = event.target.dataset.partid
        document.querySelector('#tf-edit-part').setAttribute('src', `/main/edit-part/${partId}`)

        const editModal = new bootstrap.Modal('#editPartModal')
        editModal.show()
    }
}