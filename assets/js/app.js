import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import Home from './components/Home'
/**
* Create a fresh Vue Application instance
*/
Vue.use(BootstrapVue)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


new Vue({
  el: '#app',
  components: {Home}
});