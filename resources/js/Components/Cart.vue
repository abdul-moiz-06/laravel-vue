<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Cart Items</div>

          <div class="card-body">
            <table class="table table-responsive table-bordered">
              <thead>
                <tr>
                  <th style="min-width: 350px;">Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Sub Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in cartItems">
                  <td>
                    {{ item.name }}
                    <div v-if="item.extras.length > 0">
                      <hr />
                      <table class="table table-borderless">
                        <tr>
                          <th>Extras</th>
                        </tr>
                        <tr v-for="extra in item.extras">
                          <td>{{ extra.name }}</td>
                        </tr>
                      </table>
                    </div>
                  </td>
                  <td>
                    {{ item.price }}
                    <div v-if="item.extras.length > 0">
                      <hr />
                      <table class="table table-borderless">
                        <tr>
                          <th>&nbsp;</th>
                        </tr>
                        <tr v-for="extra in item.extras">
                          <td>{{ extra.price }}</td>
                        </tr>
                      </table>
                    </div>
                  </td>
                  <td>
                    {{ item.qty }}
                    <div v-if="item.extras.length > 0">
                      <hr />
                      <table class="table table-borderless">
                        <tr>
                          <th>&nbsp;</th>
                        </tr>
                        <tr v-for="extra in item.extras">
                          <td>{{ extra.qty }}</td>
                        </tr>
                      </table>
                    </div>
                  </td>
                  <td>
                    {{ item.qty * item.price + extraServicesSum(item.extras) }}
                  </td>
                  <td>
                    <button
                      class="btn btn-default"
                      @click="removeItem(item.id)"
                    >
                      <span class="fa fa-trash-alt"></span>
                    </button>
                  </td>
                </tr>
                <tr>
                  <th>Total</th>
                  <th></th>
                  <th></th>
                  <th>{{ itemTotal }}</th>
                  <th></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
export default {
  name: 'Cart',
  mounted() {},
  methods: {
    removeItem(id) {
      this.$store.dispatch('cart/removeCart', id)
    },
    extraServicesSum(extras) {
      let extraItem = extras
      let total = 0
      total = Object.keys(extraItem).map((key) => {
        return parseInt(extraItem[key].qty) * parseFloat(extraItem[key].price)
      })

      return _.sum(total)
    }
  },
  computed: {
    cartItems() {
      return this.$store.state.cart.items
    },
    max_extras() {
      return this.$store.state.items.maxExtras
    },
    extraItem() {
      return this.$store.state.cart.extraItem
    },
    itemTotal() {
      let items = this.cartItems

      let total = 0
      total = Object.keys(items).map((key) => {
        return (
          parseInt(items[key].qty) * parseFloat(items[key].price) +
          this.extraServicesSum(items[key].extras)
        )
      })

      return _.sum(total)
    }
  }
}
</script>
