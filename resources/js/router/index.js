import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from '../views/dashboard/Index.vue'
import Clients from '../views/clients/Index.vue'
import Providers from '../views/providers/Index.vue'
import Products from '../views/products/Index.vue'
import Transactions from '../views/transactions/Index.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: Dashboard
    },
    {
        path: '/clients',
        name: 'Clients',
        component: Clients
    },
    {
        path: '/providers',
        name: 'Providers',
        component: Providers
    },
    {
        path: '/products',
        name: 'Products',
        component: Products
    },
    {
        path: '/transactions',
        name: 'Transactions',
        component: Transactions
    }
  ]
})