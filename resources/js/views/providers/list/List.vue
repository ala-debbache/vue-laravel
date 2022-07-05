<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="providers"
      sort-by="user.name"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Providers</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <add></add>
          <edit :provider="provider" :dialog="dialogEdit"></edit>
          <detail :provider="provider" :dialog="dialogDetail"> </detail>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small class="mr-2" @click="() => detailItem(item)">
          mdi-eye
        </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="getProviders"> Reset </v-btn>
      </template>
    </v-data-table>
  </div>
</template>
<script>
import Add from "./partials/Add.vue";
import Edit from "./partials/Edit.vue";
import Detail from "./partials/Detail.vue";

export default {
  data: () => ({
    dialogEdit: false,
    dialogDetail: false,
    dialogDelete: false,
    headers: [
      {
        text: "Name",
        align: "start",
        value: "user.name",
      },
      { text: "Email", value: "user.email" },
      { text: "Phone", value: "user.phone" },
      { text: "Nif", value: "nif" },
      { text: "Nis", value: "nis" },
      { text: "Actions", value: "actions", sortable: false, align: "end" },
    ],
    providers: [],
    provider: {},
    editedIndex: -1,
  }),

  components: {
    Add,
    Edit,
    Detail,
  },

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.getProviders();
    this.$bus.on("refresh-providers", this.getProviders);
    this.$bus.on("close-edit-dialog", this.closeEdit);
    this.$bus.on("close-detail-dialog", this.closeDetail);
  },

  methods: {
    async getProviders() {
      return new Promise((resolve, reject) => {
        axios
          .get("/providers")
          .then((res) => {
            resolve(res);
            this.providers = res.data;
          })
          .catch((err) => {
            console.log(err.response);
            reject(err);
          });
      });
    },

    editItem(item) {
      this.provider = item;
      this.dialogEdit = true;
    },

    closeEdit() {
      this.dialogEdit = false;
    },

    detailItem(item) {
      this.provider = item;
      this.dialogDetail = true;
    },

    closeDetail() {
      this.dialogDetail = false;
    },

    deleteItem(item) {
      this.provider = item;
      this.dialogDelete = true;
    },

    async deleteItemConfirm() {
      new Promise((resolve, reject) => {
        axios
          .delete(`/proviedrs/${this.provider.user_id}`)
          .then((res) => {
            resolve(res);
            alert("provider deleted successfully");
            this.getProviders();
            this.closeDelete();
          })
          .catch((err) => {
            reject(err);
            alert(err.response);
          });
      });
    },

    closeDelete() {
      this.dialogDelete = false;
    },
  },
};
</script>
<style lang="">
</style>