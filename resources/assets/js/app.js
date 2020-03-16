
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
let VueSelect = require('vue-select')
window.VueLocalStorage = require('vue-localstorage');

Vue.use(VueLocalStorage);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.EventBus = new Vue();
const firebase = require('firebase/app');
require('firebase/database');

var config = {
    apiKey: "AIzaSyD9WV5-HvbP10nYOLiR3LuGMI2vKAO-s2I",
    authDomain: "poss-25fb2.firebaseapp.com",
    databaseURL: "https://poss-25fb2.firebaseio.com",
    projectId: "poss-25fb2",
    storageBucket: "poss-25fb2.appspot.com",
    messagingSenderId: "1040889589953"
};
firebase.initializeApp(config);
window.database = firebase.database().ref($('meta[name=appname]').attr("content"));

Vue.component('v-select', VueSelect.VueSelect);
Vue.component('auto-cliente', require('./components/AutoCliente'));
Vue.component('auto-producto', require('./components/AutoProducto'));
Vue.component('producto-tabs', require('./components/ProductoTabs'));
Vue.component('carro-compra', require('./components/CarroCompra'));
Vue.component('modal-login', require('./components/ModalLogin'));



const app = new Vue({
    el: '#app',
    data:{
        categoria_id :1,
        modallogin:false
    },
    methods:{
        categoria(id_categoria){
            this.categoria_id = id_categoria
        },

    }
});
