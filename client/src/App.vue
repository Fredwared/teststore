<template>
  <div id="app">
    <router-link :to="{ name: 'product-list' }">Список товаров</router-link>
    <router-link :to="{ name: 'product-create' }">Новый товаров</router-link>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  components: {}
}
</script>
