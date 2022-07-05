<template>
  <v-dialog v-model="dialog" @click:outside="close" persistent max-width="1000">
    <v-card>
      <v-card-title class="text-h5"> Client details </v-card-title>

      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-account</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.clientName"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-account</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-text="item.providerName"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-for="product in item.products" :key="product.id">
          <v-list-item-avatar>
            <v-icon>mdi-package</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-html="product.name"></v-list-item-title>
          </v-list-item-content>

          <v-list-item-content>
            <v-list-item-title
              v-html="`Quantity: ${product.pivot.quantity}`"
            ></v-list-item-title>
          </v-list-item-content>

          <v-list-item-content>
            <v-list-item-title
              v-html="`Price: ${product.price} $`"
            ></v-list-item-title>
          </v-list-item-content>

          <v-list-item-content>
            <v-list-item-title
              v-html="`Total: ${product.price * product.pivot.quantity} $`"
            ></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-avatar>
            <v-icon>mdi-cash</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title
              v-text="`Total: ${item.total} $`"
            ></v-list-item-title>
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
        clientName: {},
        providerName: {},
        total: 0,
        products: [],
      },
    };
  },
  props: ["dialog", "transaction"],
  watch: {
    transaction(val) {
      this.item = {
        clientName: val.client.user.name,
        providerName: val.provider.user.name,
        total: val.total,
        products: val.products,
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