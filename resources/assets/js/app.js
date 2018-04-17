
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('show-question', require('./components/ShowQuestion.vue'));
Vue.component('rate-question', require('./components/RateQuestion.vue'));
Vue.component('edit-question', require('./components/EditQuestion.vue'));
Vue.component('edit-question-tags', require('./components/EditQuestionTags.vue'));
Vue.component('edit-question-hints', require('./components/EditQuestionHints.vue'));
Vue.component('question-hint', require('./components/QuestionHint.vue'));

const app = new Vue({
    el: '#app',
});
