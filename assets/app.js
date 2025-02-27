
import $ from 'jquery';
// things on "window" become global variables
window.$ = window.jQuery = $;

import select2 from 'select2';
select2($);

import 'select2';
import 'select2/dist/css/select2.min.css';
import '@popperjs/core';
import 'bootstrap/dist/css/bootstrap.min.css';

import 'bootstrap' //from this loads popperjs/core

import './bootstrap.js';

import { Alert } from 'bootstrap';
import * as bootstrap from 'bootstrap'; // Importation correcte de Bootstrap


$(document).ready(function () {
    $('#jquery-button').on('click', function () {
        $('#jquery-result').text('Le bouton a été cliqué, jQuery est bien actif !');
    });
});

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
 // loads the jquery package from node_modules

// Importez vos fichiers JavaScript
import './controllers/hello_controller.js';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');




