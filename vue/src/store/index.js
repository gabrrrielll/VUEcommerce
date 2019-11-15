import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    count: 3,
    products: [],
    options: [],
    cart: []
  },
  getters: { //computed properties
    filterProducts(state, getters) {
      return state.products.filter(product => product.price > 0)
    },
    cartProducts(state, getters){
      return state.cart
    }

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
        });
    },
    addProductToCart(context, product) {
      if (context.state.cart.length &&
        context.state.cart.find(el => el.id_product === product.id_product)) {
        context.commit('incrementItemQuantity', product)

      } else {
        context.commit('updateCart', product)
      }

    }

  },
  mutations: {

    setProducts(state, products) {
      state.products = products;
    },
    updateCart(state, product) {
      state.cart.push(product)
    },
    incrementItemQuantity(state, product) {
      // find item and increment
      console.log("item find in cart", state, product)
    }

  },


});
