require('./bootstrap');

window.Vue = require('vue');

import Notifications from 'vue-notification'
Vue.use(Notifications)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('question', require('./components/Question.vue').default);
Vue.component('poll', require('./components/Poll.vue').default);
// Vue.component('admin-home', require('./components/admin/AdminHome.vue'));

const app = new Vue({
    el: '#app'
});
