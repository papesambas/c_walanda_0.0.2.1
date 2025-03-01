console.log('Début de app.js ✅');


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
import './scripts/inscription.js';


// 5. Initialiser Select2
$(document).ready(function() {
    $('.select2-profession').select2();
});
console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');