<template>
  <v-app>
    <v-navigation-drawer app>
      <v-card height="100%">
        <v-navigation-drawer absolute permanent right>
          <template v-slot:prepend>
            <v-list-item two-line>
              <v-list-item-avatar>
                <img src="https://randomuser.me/api/portraits/women/81.jpg" />
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Manager</v-list-item-title>
                <v-list-item-subtitle>Logged In</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </template>

          <v-divider></v-divider>

          <v-list dense>
            <v-list-item
              :to="item.link"
              v-for="item in items"
              :key="item.title"
            >
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>
      </v-card>
    </v-navigation-drawer>
    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <!-- If using vue-router -->
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
export default {
  name: "App",
  data() {
    return {
      items: [
        {
          title: "Dashbored",
          icon: "mdi-view-dashboard",
          link: "/",
        },
        {
          title: "Clients",
          icon: "mdi-account",
          link: "/clients",
        },
        {
          title: "Providers",
          icon: "mdi-account",
          link: "/providers",
        },
        {
          title: "Products",
          icon: "mdi-shopping",
          link: "/products",
        },
        {
          title: "Transactions",
          icon: "mdi-cash",
          link: "/transactions",
        },
      ],
    };
  },
};
</script>
<style lang="">
</style>