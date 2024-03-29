import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue').default;
import Vuex from 'vuex';
import store from './store';

[Vuex].forEach((x) => Vue.use(x));
const app = new Vue({
  el: '#app',
  store,
  components: {
    List: require('./Components/List').default
  }
});
