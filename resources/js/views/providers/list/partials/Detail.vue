<template>
  <v-dialog v-model="dialog" @click:outside="close" persistent max-width="500">
    <v-card>
      <v-card-title class="text-h5"> Client details </v-card-title>

      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-account</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-email</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.email"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-phone</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.phone"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-shield-account</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.nif"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-shield-account</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.nis"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close"> Close </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  name: "Detail",
  data() {
    return {
      item: {
        name: "",
        email: "",
        phone: "",
        nif: "",
        nis: "",
      },
    };
  },
  props: ["dialog", "provider"],
  watch: {
    provider(val) {
      this.item = {
        name: val.user.name,
        email: val.user.email,
        phone: val.user.phone,
        nif: val.nif,
        nis: val.nis,
      };
    },
  },
  methods: {
    close() {
      this.$bus.emit("close-detail-dialog");
    },
  },
};
</script>
<style lang="">
</style>