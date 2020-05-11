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
Vue.component('files-list', require('./components/FilesList.vue').default);

Vue.component('admin-questions', require('./components/Admin/Questions.vue').default);

const app = new Vue({
    el: '#app'
});
