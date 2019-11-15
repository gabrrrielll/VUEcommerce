<template>
  <div id="shopping-cart">
    <h3>Shopping cart</h3>
    <ul>
      <li v-for="item in cartItems" :key="item.id_product">
        {{item.title}} --
        <button>+</button>
        0
        <button>-</button>
      </li>
      <hr />
      <li>Total price {{cartTotal}}</li>
    </ul>
  </div>
</template>
 
 <script>
export default {
  name: 'ShoppingCart',
  computed: {
    cartItems() {
      return this.$store.getters.cartProducts;
    },
    cartTotal() {
      var val = 0;
      this.$store.getters.cartProducts.forEach(item => {
        val += parseInt(item.price);
      });
      return val;
    }
  }
};
</script> 
<style scoped>
#shopping-cart {
  text-align: right;
  display: block;
  width: 100%;
  position: relative;
  right: 20px;
}
#shopping-cart ul li {
  list-style: none;
}
</style>
