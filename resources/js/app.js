require('./bootstrap');
import router from './router'
import common from './common'
window.Vue = require('vue')

Vue.mixin(common);


Vue.component('left-sidebar', require('./sub-components/left-sidebar.vue'))
Vue.component('mainapp', require('./components/mainapp.vue').default)
const app = new Vue({
    el: '#app',
    router,
});
