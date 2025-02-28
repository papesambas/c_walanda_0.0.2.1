console.log('Début de app.js ✅');

// 1. Importer jQuery en premier
//import jQuery from 'jquery';
//window.jQuery = jQuery;
//window.$ = jQuery;

//console.log('jQuery:', typeof $);  // Vérifier que jQuery est correctement chargé

// 2. Importer Select2 après jQuery
//import select2 from 'select2'; // Importer Select2 directement
//import 'select2/dist/css/select2.min.css'; // Importer le CSS de Select2

console.log('Select2:', typeof $.fn.select2); // Vérifier que Select2 est bien attaché à jQuery

// 3. Importer Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import './bootstrap.js';  // Si vous utilisez un autre fichier bootstrap.js
import '@popperjs/core';
import { Alert } from 'bootstrap';
import * as bootstrap from 'bootstrap'; // Importation correcte de Bootstrap

// 4. Importer d'autres fichiers JavaScript
import './controllers/hello_controller.js';
import './styles/app.scss';
import './scripts/anneeScolaires.js';


// 5. Initialiser Select2
$(document).ready(function() {
    $('.select2-profession').select2();
});
console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');