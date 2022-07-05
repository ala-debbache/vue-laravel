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
                label="Cient name"
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
                v-model="item.adress"
                v-validate="'required'"
                name="adress"
                label="Adress"
              ></v-text-field>
              <span class="error-msg">{{ errors.first("adress") }}</span>
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

  props: ["client", "dialog"],

  watch: {
    client(val) {
      this.item = {
        name: val.user.name,
        email: val.user.email,
        phone: val.user.phone,
        // password: val.user.password,
        adress: val.adress,
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
              .put(`/clients/${this.client.user_id}`, this.item)
              .then((res) => {
                resolve(res);
                console.log(res);
                alert("client updated successfully");
                this.$bus.emit("refresh-clients");
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