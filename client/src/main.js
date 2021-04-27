import Vue from 'vue'
import App from './App.vue'
import VueRouter from "vue-router";

Vue.use(VueRouter);

import ProductList from "./views/ProductList";
import Product from "./views/Product";
import ProductEdit from "./views/ProductEdit";
import ProductCreate from "./views/ProductCreate";

Vue.config.productionTip = false

const routes = [
  { path: '/products', name: 'product-list',component: ProductList },
  { path: '/products/:id', name: 'product-show', component: Product, props: true},
  { path: '/products/:id/edit', name: 'product-edit', component: ProductEdit, props: true},
  { path: '/products/create', name: 'product-create', component: ProductCreate}
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
