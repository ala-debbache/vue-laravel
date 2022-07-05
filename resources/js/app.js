// require('./bootstrap');

import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
import VeeValidate from 'vee-validate';
import VueBus from 'vue-bus';
import 'vuetify/dist/vuetify.min.css';
import axios from 'axios';
import App from './App.vue';

window.axios = axios;
Vue.use(Vuetify);
Vue.use(VeeValidate);
Vue.use(VueBus);

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    components: { App },
    template: '<App/>'  
});
