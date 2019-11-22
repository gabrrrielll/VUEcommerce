<template>
  <b-modal id="modal-cart" hide-footer>
    <h5><center>Shopping cart</center></h5>
    <b-alert show v-if="!cartItems.length"> Your cart is empty </b-alert>
    <div v-if="cartItems.length" id="shopping-cart">
      <table>
        <tr>
          <th>Items</th>
          <th>Price</th>
          <th>Quantity</th>
        </tr>
        <tr v-for="item in cartItems" :key="item.price">
          <td v-if="item.quantity > 0">{{ item.title }}</td>
          <td v-if="item.quantity > 0">{{ item.price }}</td>
          <td v-if="item.quantity > 0">
            x {{ item.quantity }}
            <span @click="increment(item)">
              <ios-add-circle-icon title="Increase quantity" />
            </span>
            <span @click="decrement(item)">
              <ios-remove-circle-icon title="Decrease quantity" />
            </span>
          </td>
        </tr>

        <tr>
          <th>Total price</th>
          <td>{{ cartTotal }}</td>
          <td>QTY: {{ cartProductsCount }}</td>
        </tr>
      </table>
    </div>
  </b-modal>
</template>

<script>
export default {
  name: "ShoppingCart",
  computed: {
    cartItems() {
      return this.$store.getters.cartProducts;
    },

    cartTotal() {
      return this.$store.getters.cartProducts.reduce(
        (acc, item) => acc + parseInt(item.price) * item.quantity,
        0
      );
    },

    cartProductsCount() {
      return this.$store.getters.cartProducts.reduce(
        (acc, item) => acc + item.quantity,
        0
      );
    }
  },

  methods: {
    increment(item) {
      this.$store.dispatch("addProductToCart", item);
    },
    decrement(item) {
      this.$store.dispatch("decrementQuantity", item);
    }
  }
};
</script>

<style scoped>
#shopping-cart {
  text-align: right;
  display: block;
  width: 300px;
  position: relative;
  right: 0;
  left: 50%;
}
</style>
