<template>
  <div
    class="modal fade"
    id="cartModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
    data-backdrop="static"
    data-keyboard="false"
    ref="modal"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Item Extras</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="resetExtraItem"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-centered mb-0">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in extraItems">
                <td>{{ item.name }}</td>
                <td>{{ item.price }}</td>
                <td>
                  <div class="input-group">
                    <span class="input-group-prepend" @click="minusQty(item)">
                      <span class="input-group-text">
                        <i class="fa fa-minus"></i>
                      </span>
                    </span>
                    <span class="form-control"
                      >{{
                        extraItem.length > 0 &&
                        extraItem.some((ex_item) => ex_item.id === item.id)
                          ? extraItem.find((ex_item) => ex_item.id === item.id)
                              .qty
                          : 0
                      }}
                    </span>
                    <span class="input-group-append" @click="addQty(item)">
                      <span class="input-group-text">
                        <i class="fa fa-plus"></i>
                      </span>
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" @click="addToCart">
            Add To Cart
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
export default {
  name: 'Modal',
  data() {
    return {}
  },
  methods: {
    addToCart() {
      let existingItem = this.existingCartItem
      let extraItems = this.extraItem.filter((item) => item.qty > 0)
      let obj = Object.assign({}, existingItem, { extras: extraItems })

      this.$store.dispatch('cart/addToCart', obj)
      $('#cartModal').modal('hide')
      this.resetExtraItem()
    },
    resetExtraItem() {
      this.$store.dispatch('cart/resetExtraItem')
    },
    addQty(item) {
      this.$store.dispatch('cart/setExtraItem', item)
    },
    minusQty(item) {
      this.$store.dispatch('cart/removeExtraItem', item)
    }
  },
  computed: {
    extraItems() {
      return this.$store.state.items.extraItems
    },
    existingCartItem() {
      return this.$store.state.cart.cartItem
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
