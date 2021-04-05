require('./bootstrap');
window.Vue = require('vue');
window.JQuery = require('jquery');


import VueTheMask from 'vue-the-mask';
import {
    ValidationProvider,
    ValidationObserver
} from 'vee-validate/dist/vee-validate.full';
import VeeValidateLaravel from 'vee-validate-laravel';

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.use(VueTheMask);
Vue.use(VeeValidateLaravel);

const axios = require('axios').default;