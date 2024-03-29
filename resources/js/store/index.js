import Vue from 'vue';
import Vuex from 'vuex';
import cart from './modules/cart';
import items from './modules/items';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [createPersistedState()],

  modules: {
    cart: cart,
    items: items
  }
});
