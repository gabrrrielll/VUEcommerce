import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '../components/HelloWorld.vue'
import ProductsListing from '../components/ProductsListing.vue'
import ShoppingCart from '../components/ShoppingCart.vue'

Vue.use(Router)

export default new Router({
  routes: [{
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/products/',
      name: 'ProductsListing',
      component: ProductsListing,

    },
    {
      path: '/cart',
      name: 'ShoppingCart',
      component: ShoppingCart,
    }
  ]
})
