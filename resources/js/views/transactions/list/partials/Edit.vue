<template>
  <v-dialog v-model="dialog" @click:outside="close" max-width="1000px">
    <v-card>
      <v-card-title>
        <span class="text-h5">Edit client</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="8">
              <v-select
                :items="clients"
                item-text="user.name"
                item-value="id"
                label="Client"
                name="client"
                v-validate="'required'"
                v-model="item.client_id"
              ></v-select>
              <span class="error-msg">{{ errors.first("client") }}</span>
            </v-col>

            <v-col cols="12" sm="6" md="8">
              <v-select
                :items="providers"
                item-text="user.name"
                item-value="id"
                label="Provider"
                name="provider"
                v-validate="'required'"
                v-model="item.provider_id"
              ></v-select>
              <span class="error-msg">{{ errors.first("provider") }}</span>
            </v-col>

            <v-row
              v-for="(selectedProduct, i) in selectedProducts"
              :index="i"
              :key="i"
            >
              <v-col cols="12" sm="4" md="4">
                <v-select
                  :items="filterProducts(selectedProduct.product)"
                  item-text="name"
                  item-value="id"
                  return-object
                  label="Product"
                  name="product"
                  v-validate="'required'"
                  v-model="selectedProduct.product"
                ></v-select>
                <span class="error-msg">{{ errors.first("product") }}</span>
              </v-col>

              <v-col cols="12" sm="2" md="2">
                <v-text-field
                  v-model="selectedProduct.quantity"
                  v-validate="
                    `required|numeric|max_value:${selectedProduct.product.quantity}`
                  "
                  :name="`quantity${i}`"
                  label="Quantity"
                  type="number"
                  min="0"
                  :max="selectedProduct.product.quantity"
                ></v-text-field>
                <span class="error-msg">{{
                  errors.first(`quantity${i}`)
                }}</span>
              </v-col>

              <v-col cols="12" sm="2" md="2">
                <v-text-field
                  readonly
                  name="price"
                  label="Unit price"
                  type="number"
                  v-model="selectedProduct.product.price"
                ></v-text-field>
              </v-col>
              <v-col cols="2" sm="2" md="2">
                <v-text-field
                  name="total"
                  label="Total"
                  type="number"
                  :value="setTotalProduct(i)"
                ></v-text-field>
              </v-col>

              <v-col cols="2" sm="2" md="2">
                <v-btn
                  icon
                  color="blue"
                  v-if="
                    i === selectedProducts.length - 1 &&
                    selectedProducts.length !== products.length
                  "
                  @click="() => addproduct()"
                >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
                <v-btn
                  icon
                  color="red"
                  v-if="selectedProducts.length > 1"
                  @click="() => removeproduct(i)"
                >
                  <v-icon>mdi-minus</v-icon>
                </v-btn>
              </v-col>
            </v-row>

            <v-col cols="12" sm="6" md="8">
              <v-text-field
                readonly
                name="total"
                v-validate="'required|numeric|min_value:1'"
                label="Total"
                type="number"
                v-model="total"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("total") }}</span>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
        <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  name: "Edit",
  data() {
    return {
      item: {},
      selectedProducts: [],
    };
  },

  props: ["transaction", "dialog", "clients", "providers", "products"],

  watch: {
    transaction(val) {
      console.log(this.transaction);
      this.item = {
        ...this.transaction,
      };
      this.selectedProducts = this.transaction.products.map((e) => {
        return {
          product: e,
          quantity: e.pivot.quantity,
        };
      });
    },
  },
  methods: {
    close() {
      this.item = {};
      this.errors.clear();
      this.$bus.emit("close-edit-dialog");
    },

    addproduct() {
      if (this.products.length === this.selectedProducts.length) {
        alert("you can't add another product");
      } else {
        this.selectedProducts.push({
          product: {},
          quantity: 0,
        });
      }
    },

    removeproduct(i) {
      if (this.selectedProducts.length === 1) {
        alert("you can't do that");
      } else {
        this.selectedProducts.splice(i, 1);
      }
    },

    setTotalProduct(i) {
      return (
        this.selectedProducts[i].product.price *
        this.selectedProducts[i].quantity
      );
    },

    async save() {
      this.$validator.validate("*").then((valid) => {
        if (valid) {
          return new Promise((resolve, reject) => {
            axios
              .put(`/transactions/${this.transaction.id}`, {
                ...this.item,
                total: this.total,
                products: this.selectedProducts.filter(
                  (product) =>
                    Object.keys(product.product).length && product.quantity > 0
                ),
              })
              .then((res) => {
                resolve(res);
                console.log(res);
                alert("transaction updated successfully");
                this.$bus.emit("refresh-transactions");
                this.close();
              })
              .catch((err) => {
                reject(err);
                console.log(err.response.data);
                alert(err.response.data.message);
              });
          });
        }
      });
    },

    filterProducts(product) {
      const filtred = this.products.filter((element) => {
        return !this.selectedProducts.some(
          (elem) => element.id === elem.product.id
        );
      });
      if (Object.keys(product).length) {
        filtred.push(product);
      }
      return filtred;
    },
  },
  computed: {
    total() {
      let totalPrice = 0;
      this.selectedProducts.forEach((e) => {
        if (Object.keys(e.product).length) {
          totalPrice = totalPrice + e.product.price * e.quantity;
        }
      });
      return totalPrice;
    },
  },
};
</script>
<style lang="">
</style>