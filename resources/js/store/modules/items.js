import serverConstants from './../../contants';

const state = () => ({
  all: [],
  extraItems: [],
  maxExtras: 0
});

const getters = {
  getAll(state) {
    return state.all;
  },

  getExtraItems(state) {
    return state.extraItems;
  }
};

const mutations = {
  setItems(state, payload) {
    state.all = payload;
  },

  setExtraItems(state, payload) {
    state.extraItems = payload;
  },

  setMaxExtras(state, payload) {
    state.maxExtras = payload;
  }
};

const actions = {
  async fetchAll({ commit }) {
    axios.get(serverConstants.v1_url + '/items').then((response) => {
      commit('setItems', response.data.data);
    });
  },

  async fetchAllExtras({ commit }) {
    axios.get(serverConstants.v1_url + '/extra-items').then((response) => {
      commit('setExtraItems', response.data.data);
    });
  },

  async setMaxExtras({ commit }, payload) {
    commit('setMaxExtras', payload);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
