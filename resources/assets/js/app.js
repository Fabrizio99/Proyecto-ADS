import router from './routes.js';
import AppComponent from './components/AppComponent'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Axios from 'axios'
window.axios = Axios;
import service from './services';
window.service = service;

require('bootstrap');

var $ = require('jquery');
window.$ = $;

import fechaActual from './fecha'
window.fecha = fechaActual;

let moment = require('moment');
window.moment = moment;

window.Vue = require('vue');
Vue.use(VueSweetalert2);

if(Array.prototype.includes == undefined) {
    console.log('entra aca');
    Array.prototype.includes = function() {
        return Array.prototype.indexOf.apply(this, arguments) !== -1;
    };
}
const app = new Vue({
    components: { AppComponent },
    router
}).$mount('#app')
