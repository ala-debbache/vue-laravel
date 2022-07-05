<template>
  <v-dialog v-model="dialog" @click:outside="close" max-width="500px">
    <v-card>
      <v-card-title>
        <span class="text-h5">Edit client</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.name"
                v-validate="'required'"
                name="name"
                label="Product name"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("name") }}</span>
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.price"
                v-validate="'required|decimal'"
                name="price"
                label="Price"
                type="number"
              ></v-text-field>
              <span
                class="error-msg"
                v-for="error in errors.collect('price')"
                :key="error"
                >{{ error }}</span
              >
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.quantity"
                v-validate="'required|integer'"
                name="quantity"
                label="quantity"
                type="number"
              ></v-text-field>
              <span
                class="error-msg"
                v-for="error in errors.collect('quantity')"
                :key="error"
                >{{ error }}</span
              >
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-textarea
                label="Description"
                v-model="item.description"
                name="description"
              ></v-textarea>
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
    };
  },

  props: ["product", "dialog"],

  watch: {
    product(val) {
      this.item = {
        name: val.name,
        price: val.price,
        quantity: val.quantity,
        description: val.description,
      };
    },
  },
  methods: {
    close() {
      this.item = {};
      this.errors.clear();
      this.$bus.emit("close-edit-dialog");
    },
    async save() {
      // console.log(this.item);
      this.$validator.validate("*").then((valid) => {
        if (valid) {
          return new Promise((resolve, reject) => {
            axios
              .put(`/products/${this.product.id}`, this.item)
              .then((res) => {
                resolve(res);
                console.log(res);
                alert("product updated successfully");
                this.$bus.emit("refresh-products");
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
  },
};
</script>
<style lang="">
</style>