import router from './routes.js';
import AppComponent from './components/AppComponent'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Axios from 'axios'
window.axios = Axios;
let usuario = require('./user.js').default;

//window.Usuario = new usuario();

var $ = require('jquery');
window.$ = $;
require('bootstrap');

window.Vue = require('vue');
Vue.use(VueSweetalert2);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import * as Alerts from '../js/alerts';
window.Alert = Alerts;
const app = new Vue({
    components: { AppComponent },
    router
}).$mount('#app')
