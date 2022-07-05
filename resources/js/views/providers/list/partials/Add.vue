<template>
  <v-dialog v-model="dialog" @click:outside="close" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
        New Item
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Add new provider</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.name"
                v-validate="'required'"
                name="name"
                label="Provider name"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("name") }}</span>
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.email"
                v-validate="'required|email'"
                name="email"
                label="Email"
              ></v-text-field>
              <span
                class="error-msg"
                v-for="error in errors.collect('email')"
                :key="error"
                >{{ error }}</span
              >
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.phone"
                v-validate="'required|numeric|length:10'"
                name="phone"
                label="Phone"
              ></v-text-field>
              <span
                class="error-msg"
                v-for="error in errors.collect('phone')"
                :key="error"
                >{{ error }}</span
              >
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.password"
                v-validate="'required|min:8'"
                name="password"
                label="Password"
              ></v-text-field>
              <span
                class="error-msg"
                v-for="error in errors.collect('password')"
                :key="error"
                >{{ error }}</span
              >
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.nif"
                v-validate="'required'"
                name="nif"
                label="Nif"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("nif") }}</span>
            </v-col>

            <v-col cols="12" sm="6" md="10">
              <v-text-field
                v-model="item.nis"
                v-validate="'required'"
                name="nis"
                label="Nis"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("nis") }}</span>
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
      this.$validator.validate("*").then((valid) => {
        if (valid) {
          return new Promise((resolve, reject) => {
            axios
              .post("/providers/create", this.item)
              .then((res) => {
                resolve(res);
                alert("provider created successfully");
                this.$bus.emit("refresh-providers");
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