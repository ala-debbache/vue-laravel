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
            <v-icon>mdi-cash</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="`${item.price} $`"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-package</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.quantity"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-format-list-bulleted</v-icon>
          </v-list-item-avatar>

          <v-list-item-content v-text="item.description"> </v-list-item-content>
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
        price: "",
        quantity: "",
        description: "",
      },
    };
  },
  props: ["dialog", "product"],
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
      this.$bus.emit("close-detail-dialog");
    },
  },
};
</script>
<style lang="">
</style>