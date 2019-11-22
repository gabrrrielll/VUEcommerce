<template>
  <div>
    <div id="show-btn" @click="$bvModal.show('modal-cart')">
      <ios-cart-icon w="30px" h="30px" title="Your Cart" /> Cart
    </div>
    <div v-if="this.$store.state.loading === false">
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </div>
    <ShoppingCart />
    <hr />
    <b-card-group deck>
      <b-card
        v-for="product in products"
        :key="product.id_product"
        :img-src="setRepresentativeImage(product.featured)"
        img-top
      >
        <b-card-title>{{ product.title }}</b-card-title>
        <b-card-sub-title class="mb-2">{{ product.price }}</b-card-sub-title>
        <b-button
          variant="outline-primary"
          class="add-to-cart"
          @click="addToCart(product)"
          title="Add to cart"
        >
          <ios-cart-icon w="22px" h="22px" title="Add to cart" /> Add to cart
        </b-button>
      </b-card>
    </b-card-group>
  </div>
</template>

<script>
import ShoppingCart from "./ShoppingCart.vue";
export default {
  name: "ProductsListing",

  components: {
    ShoppingCart
  },

  computed: {
    products() {
      //return this.$store.state.products;
      return this.$store.getters.filterProducts;
    }
  },
  methods: {
    setRepresentativeImage(img) {
      if (img !== false) {
        return img;
      } else return require(".././assets/img/no-image.png");
    },
    addToCart(product) {
      this.$store.dispatch("addProductToCart", product);
    }
  },
  created() {
    this.$store.dispatch("getProducts");
  }
};
</script>

<style>
svg.ion__svg {
  bottom: -4px;
  position: relative;
}
img.card-img-top {
  height: 50%;
}
</style>
