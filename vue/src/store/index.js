import Vuex from 'vuex'
import Vue from 'vue'


Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    count: 3,
    products: [],
    options: [],
    cart: [],
    loading: false
  },
  getters: {

    filterProducts(state, getters) {
      return state.products.filter(product => product.price > 0)
    },
    cartProducts(state, getters) {
      return state.cart

    },


  },
  actions: {

    getProducts(context) {
      let url = 'http://127.0.0.1/wordpress/wp-json/wpvue/search/';
      fetch(url)
        .then(response => {
          return response.json();
        })
        .then(data => {
          context.commit('setProducts', data);
          this.loading = true;
        });
    },

    addProductToCart({
      state,
      getters,
      commit
    }, product) {

      const cartItem = state.cart.find(item => item.id_product === product.id_product)
      if (!cartItem) {
        commit('updateCart', product)

      } else {
        commit('incrementItemQuantity', cartItem)

      }

    },
    decrementQuantity({
      state,
      getters,
      commit
    }, product) {

      commit('decrementItemQuantity', product)
    }

  },
  mutations: {

    setProducts(state, products) {
      products.map(item => item.quantity = 1)
      state.products = products;
      state.loading = true;
    },

    updateCart(state, product) {
      state.cart.push(product)
    },

    incrementItemQuantity(state, product) {
      product.quantity++
    },

    decrementItemQuantity(state, product) {
      product.quantity--
    }

  },


});
