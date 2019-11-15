<template>
  <div>
    <ShoppingCart />
    <hr />
    <div id="main">
      <div v-for="product in products" :key="product.id_product" class="product">
        <a :href="product.permalink">
          <h3>{{product.title}}</h3>
          <div class="product-img">
            <img :src="setRepresentativeImage(product.featured)" :alt="product.title" />
          </div>
          <div class="price">{{product.price}}</div>
        </a>
        <div class="add-to-cart" @click="addToCart(product)">
          <button>Add to cart</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ShoppingCart from './ShoppingCart.vue';
export default {
  name: 'ProductsListing',

  components: {
    ShoppingCart
  },

  computed: {
    products() {
      return this.$store.state.products;
      //return this.$store.getters.filterProducts;
    }
  },
  methods: {
    setRepresentativeImage(img) {
      //console.log('url----->', window.location.host);
      if (img !== false) {
        return img;
      } else return require('.././assets/img/no-image.png');
    },
    addToCart(product) {
      this.$store.dispatch('addProductToCart', product);
    }
  },
  created() {
    this.$store.dispatch('getProducts');
  }
};
</script>

<style>
#main {
  display: flex;
  justify-content: space-between;
}
.product {
  width: 20%;
}
.product-img img {
  max-width: 100px;
}
</style>