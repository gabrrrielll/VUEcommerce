import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    count: 3,
    products: [],
    options: []
  },
  getters: { //computed properties

  },
  actions: {
    fetchProducts() {
      //make the call
      // run setProducts mutation
    }

  },
  mutations: {

    setProducts(state, products) {
      state.products = products;

    },

  },


});
