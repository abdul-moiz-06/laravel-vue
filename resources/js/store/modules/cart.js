import _ from 'lodash';

const state = () => ({
  items: [],
  cartItem: [],
  extraItem: []
});

const getters = {
  getAll(state) {
    return state.items;
  }
};

const mutations = {
  setCart(state, payload) {
    if (
      state.items.length > 0 &&
      state.items.some((item) => item.id === payload.id)
    ) {
      let index = state.items.findIndex((item) => item.id === payload.id);
      state.items[index].qty += 1;
      if (state.items[index].extras.length === 0)
        state.items[index].extras =
          payload.extras && payload.extras.length > 0 ? payload.extras : [];
    } else {
      let item = {
        id: payload.id,
        name: payload.name,
        price: payload.price,
        qty: 1,
        extras:
          payload.extras && payload.extras.length > 0 ? payload.extras : []
      };
      state.items.push(item);
    }
  },

  removeItem(state, payload) {
    if (
      state.items.length > 0 &&
      state.items.some((item) => item.id === payload)
    ) {
      let index = state.items.findIndex((item) => item.id === payload);
      state.items.splice(index, 1);
    }
  },

  setCartItem(state, payload) {
    state.cartItem = payload;
  },

  setExtraItem(state, payload) {
    if (state.extraItem.length > 0) {
      let totalExtraQty = Object.keys(state.extraItem).map((key) => {
        return state.extraItem[key].qty;
      });

      let totalSum = _.sum(totalExtraQty);

      if (
        (payload.max_extras > 0 && payload.max_extras <= totalSum) ||
        payload.max_extras === 0
      ) {
        return;
      }
    }

    if (
      state.extraItem.length > 0 &&
      state.extraItem.some((item) => item.id === payload.item.id)
    ) {
      let index = state.extraItem.findIndex(
        (item) => item.id === payload.item.id
      );

      state.extraItem[index].qty += 1;
    } else {
      let item = {
        id: payload.item.id,
        name: payload.item.name,
        price: payload.item.price,
        qty: 1
      };
      state.extraItem.push(item);
    }
  },
  removeExtraItem(state, payload) {
    if (
      state.extraItem.length > 0 &&
      state.extraItem.some((item) => item.id === payload.id)
    ) {
      let index = state.extraItem.findIndex((item) => item.id === payload.id);
      if (state.extraItem[index].qty > 0) state.extraItem[index].qty -= 1;
    }
  },
  resetExtraItem(state) {
    state.extraItem = [];
  }
};

const actions = {
  async addToCart({ commit }, item) {
    commit('setCart', item);
  },

  async setCartItem({ commit }, item) {
    commit('setCartItem', item);
  },

  async removeCart({ commit }, id) {
    commit('removeItem', id);
  },

  async setExtraItem({ commit, rootState }, item) {
    commit('setExtraItem', {
      item: item,
      max_extras: rootState.items.maxExtras,
      max_items: rootState.items.extraItems
    });
  },

  async removeExtraItem({ commit }, item) {
    commit('removeExtraItem', item);
  },

  resetExtraItem({ commit }) {
    commit('resetExtraItem');
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
