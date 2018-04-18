
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueMultiSelect from 'vue-multiselect';

window.Vue = require('vue');

// Dependency Usage
Vue.component('multiselect', VueMultiSelect);

// CSRF Token override
Vue.prototype.$http = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// Tasks
Vue.component('task-list', require('./components/tasks/TaskListComponent.vue'));
Vue.component('task-create', require('./components/tasks/TaskCreateComponent.vue'));
Vue.component('task-edit', require('./components/tasks/TaskEditComponent.vue'));

// Tags
Vue.component('tags', require('./components/tags/TagComponent.vue'));

const app = new Vue({
    el: '#app'
});
