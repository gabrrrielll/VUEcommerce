<template>
  <div id="main">
    <h3>All Products</h3>
    <div v-for="product in products" :key="product.id" class="product">
      <a :href="product.permalink">
        <h3>{{product.title}}</h3>
        <div class="product-img">
          <img :src="setRepresentativeImage(product.featured)" :alt="product.title" />
        </div>
        <div class="price">{{product.price}}</div>
      </a>
    </div>
  </div>
</template>

<script>
import store from '../store';
export default {
  name: 'ProductsListing',

  computed: {
    products() {
      return store.state.products;
    }
  },
  methods: {
    setRepresentativeImage(img) {
      console.log('url----->', window.location.host);
      if (img !== false) {
        return img;
      } else return require('.././assets/img/no-image.png');
    },
    getProducts() {
      let url = 'http://127.0.0.1/wordpress/wp-json/wpvue/search/';

      fetch(url)
        .then(response => {
          return response.json();
        })
        .then(data => {
          store.commit('setProducts', data);
        });
    }
  },
  created() {
    this.getProducts();
  }
};
</script>

<style>
</style>