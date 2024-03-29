<template>
  <div class="container mt-5">
    <div class="d-flex justify-content-between my-4">
      <h4>Items</h4>
    </div>
    <table class="table table-bordered table-centered mb-0">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Price</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items">
          <td>{{ item.name }}</td>
          <td>{{ item.price }}</td>
          <td class="table-action text-center">
            <a
              v-if="item.max_extras > 0 || item.max_extras === -1"
              href="javascript: void(0);"
              class="btn btn-success"
              data-toggle="modal"
              data-target="#cartModal"
              @click="addExtras(item.max_extras, item)"
            >
              Add to cart</a
            >
            <a
              v-else
              href="javascript: void(0);"
              class="btn btn-success"
              @click="addToCart(item)"
            >
              Add to cart</a
            >
          </td>
        </tr>
      </tbody>
    </table>
    <cart></cart>
    <Modal></Modal>
  </div>
</template>

<script>
import Cart from './Cart'
import Modal from './Common/Modal'
import _ from 'lodash'
export default {
  name: 'List',
  components: { Modal, Cart },
  data() {
    return {}
  },
  watch: {
    qty: {}
  },
  mounted() {
    this.$store.dispatch('items/fetchAll')
  },
  methods: {
    async addToCart(item) {
      this.$store.dispatch('cart/addToCart', item)
    },
    addExtras(max_extras, item) {
      this.$store.dispatch('cart/setCartItem', item)
      this.$store.dispatch('items/fetchAllExtras')
      this.$store.dispatch('items/setMaxExtras', max_extras)
    }
  },
  computed: {
    items() {
      return this.$store.state.items.all
    },
    max_extras() {
      return this.$store.state.items.maxExtras
    },
    extraItem() {
      return this.$store.state.cart.extraItem
    }
  }
}
</script>

<style scoped></style>
