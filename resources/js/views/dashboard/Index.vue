<template>
  <div class="dashboard">
    <v-row>
      <v-col>
        <v-card class="mx-auto" color="#227c9d" dark max-width="300">
          <v-card-title>
            <v-icon large left> mdi-account </v-icon>
            <span class="text-h6 font-weight-bold">Clients</span>
          </v-card-title>
          <v-card-text
            class="text-h3 font-weight-bold"
            v-text="stats.clients_count"
          ></v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <v-card class="mx-auto" color="#17c3b2" dark max-width="300">
          <v-card-title>
            <v-icon large left> mdi-account </v-icon>
            <span class="text-h6 font-weight-bold">Providers</span>
          </v-card-title>
          <v-card-text
            class="text-h3 font-weight-bold"
            v-text="stats.providers_count"
          ></v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <v-card class="mx-auto" color="#ffcb77" dark max-width="300">
          <v-card-title>
            <v-icon large left> mdi-package </v-icon>
            <span class="text-h6 font-weight-bold">Products</span>
          </v-card-title>
          <v-card-text
            class="text-h3 font-weight-bold"
            v-text="stats.products_count"
          ></v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <v-card class="mx-auto" color="#3a86ff" dark max-width="300">
          <v-card-title>
            <v-icon large left> mdi-cart </v-icon>
            <span class="text-h6 font-weight-bold">Transactions</span>
          </v-card-title>
          <v-card-text
            class="text-h3 font-weight-bold"
            v-text="stats.transactions_count"
          ></v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" xl="6" md="8" lg="6">
        <v-list color="#bde0fe" rounded>
          <v-list-item-title class="text-h6">
            Top 5 clients transactions</v-list-item-title
          >
          <v-list-item v-for="(item, i) in topClientsTransactions" :key="i">
            <v-list-item-content>
              <v-list-item-title v-text="item.user.name"></v-list-item-title>
            </v-list-item-content>
            <v-list-item-content>
              <v-list-item-title
                v-text="item.transactions_count"
              ></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>

      <v-col cols="12" xl="6" md="8" lg="6">
        <v-list color="#bde0fe" rounded>
          <v-list-item-title class="text-h6"
            >Top 5 clients spending</v-list-item-title
          >
          <v-list-item v-for="(item, i) in topClientsSpending" :key="i">
            <v-list-item-content>
              <v-list-item-title v-text="item.user.name"></v-list-item-title>
            </v-list-item-content>
            <v-list-item-content>
              <v-list-item-title
                v-text="item.transactions_sum_total"
              ></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" xl="6" md="8" lg="6">
        <v-list color="#eae2b7" rounded>
          <v-list-item-title class="text-h6"
            >Top 5 sold products</v-list-item-title
          >
          <v-list-item v-for="(item, i) in topProductsSales" :key="i">
            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
            </v-list-item-content>
            <v-list-item-content>
              <v-list-item-title
                v-text="item.transactions_sum_product_transactionquantity"
              ></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>

      <v-col cols="12" xl="6" md="8" lg="6">
        <v-list color="#eae2b7" rounded>
          <v-list-item-title class="text-h6"
            >Top 5 transactions</v-list-item-title
          >
          <v-list-item v-for="(item, i) in topTransactionsSales" :key="i">
            <v-list-item-content>
              <v-list-item-title
                v-text="item.client.user.name"
              ></v-list-item-title>
            </v-list-item-content>
            <v-list-item-content>
              <v-list-item-title v-text="item.total"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>
    </v-row>
  </div>
</template>
<script>
export default {
  name: "Index",
  data: () => ({
    itemsPerPage: 4,
    stats: {},
    topClientsTransactions: [],
    topClientsSpending: [],
    topProductsSales: [],
    topTransactionsSales: [],
  }),
  mounted() {
    this.getData();
  },
  methods: {
    async getData() {
      return new Promise((resolve, reject) => {
        axios
          .get("/dashboard")
          .then((res) => {
            resolve(res);
            console.log(res);
            this.stats = res.data.stats;
            this.topClientsTransactions = res.data.top_clients_transactions;
            this.topClientsSpending = res.data.top_clients_spending;
            this.topProductsSales = res.data.top_products_sales;
            this.topTransactionsSales = res.data.top_traansactions_sales;
          })
          .catch((err) => {
            console.log(err.response);
            reject(err);
          });
      });
    },
  },
};
</script>
<style lang="">
</style>