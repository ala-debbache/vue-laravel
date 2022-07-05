<template>
  <v-dialog v-model="dialog" @click:outside="close" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
        New Item
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Add new product</span>
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
        <v-btn
          color="blue darken-1"
          text
          @click="save"
          :disabled="errors.items.length > 0"
        >
          Save
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import axios from "axios";

export default {
  name: "Add",
  data() {
    return {
      dialog: false,
      item: {},
      errorsServer: {},
    };
  },
  methods: {
    close() {
      this.dialog = false;
      this.item = {};
      this.errors.clear();
    },
    async save() {
      console.log(this.item);
      this.$validator.validate("*").then((valid) => {
        if (valid) {
          return new Promise((resolve, reject) => {
            axios
              .post("/products/create", this.item)
              .then((res) => {
                resolve(res);
                console.log(res);
                alert("product created successfully");
                this.$bus.emit("refresh-products");
                this.close();
              })
              .catch((err) => {
                reject(err);
                alert(err.response.data.message);
              });
          });
        }
      });
    },
  },
};
</script>
<style scoped>
.error-msg {
  color: rgb(233, 72, 72);
}
</style>