import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '../components/HelloWorld.vue'
import ProductsListing from '../components/ProductsListing.vue'

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

    }
  ]
})
