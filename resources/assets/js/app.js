
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/* importando o Vuex que foi instalado */
import Vuex from 'Vuex';
/* Agora informo pro Vue utilizar o Vuex na sua aplicação  */
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 //Vuex
 const store = new Vuex.Store({
     state:{
         item:{}
     },
     mutations:{
         setItem(state, obj){
            state.item = obj;
         }
     }

 });



Vue.component('topo', require('./components/Topo.vue'));
Vue.component('painel', require('./components/Painel.vue'));
Vue.component('caixa', require('./components/Caixa.vue'));
Vue.component('pagina', require('./components/Pagina.vue'));
Vue.component('tabela-lista', require('./components/TabelaLista.vue'));
Vue.component('migalhas', require('./components/Migalhas.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modallink', require('./components/modal/ModalLink.vue'));
Vue.component('formulario', require('./components/Formulario.vue'));
//Vue.component('ckeditor', require('vue-ckeditor2'));
Vue.component('artigocard', require('./components/ArtigoCard.vue'));

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
        console.log("ok");
        //elimina o bug de mostrar a tela sem  formatação por que o script do Vue é o último a carregar
        //em "app.blade.php" inseri um display:none na div #app e agora depois do scrip carregado removo o display:none com um block
        document.getElementById('app').style.display = "block";
    }
});
