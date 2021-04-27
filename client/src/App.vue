<template>
  <div id="app">
    <div class="btn-group">
      <router-link class="btn btn-md btn-info" :to="{ name: 'product-list' }">Список товаров</router-link>
      <router-link class="btn btn-md btn-primary" :to="{ name: 'product-create' }">Новый товаров</router-link>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css'
export default {
  name: 'App',
  components: {}
}
</script>
