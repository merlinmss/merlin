import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'chosen-js/chosen.jquery.min.js';
import 'chosen-js/chosen.min.css';

// Initialize chosen
$(document).ready(function () {
    $('.chosen-select').chosen({
        width: '100%'
    });
});
