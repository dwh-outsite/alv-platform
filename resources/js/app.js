require('./bootstrap');

window.Vue = require('vue');

import Notifications from 'vue-notification'
Vue.use(Notifications)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('connection-status', require('./components/ConnectionStatus.vue').default);
Vue.component('question', require('./components/Question.vue').default);
Vue.component('poll', require('./components/Poll.vue').default);
Vue.component('files-list', require('./components/FilesList.vue').default);

Vue.component('admin-questions', require('./components/Admin/Questions.vue').default);
Vue.component('admin-participants', require('./components/Admin/Participants.vue').default);
Vue.component('admin-polls', require('./components/Admin/Polls.vue').default);
Vue.component('admin-lower-thirds', require('./components/Admin/LowerThirds.vue').default);
Vue.component('admin-hide-button', require('./components/Admin/HideButton.vue').default);
Vue.component('admin-show-agenda', require('./components/Admin/ShowAgenda.vue').default);
Vue.component('admin-show-vote-countdown', require('./components/Admin/ShowVoteCountdown.vue').default);

Vue.component('stream-output', require('./components/StreamOutput/StreamOutput.vue').default);

const app = new Vue({
    el: '#app'
});
