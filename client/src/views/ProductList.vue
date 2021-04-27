<template>
  <div class="container">
    <div>
      <form @submit.prevent="search">
        <div class="form-group">
          <label for="search">Поиск товара</label>
          <input type="text" class="form-control" v-model="query" placeholder="Название торава" @keyup="search" />
        </div>
      </form>
    </div>
    <div v-if="loading">
      Подгружается список товаров
    </div>
    <div v-else-if="products.length" class="products" v-for="product in products" :key="product.id">
      <div class="product-item pt-3 pb-2">
        <span class="product-item__name mr-4">{{ product.name }}</span>
        <div class="btn-group">
          <router-link class="btn btn-sm btn-success product-item__link" :to="{ name: 'product-show', params: { id: product.id } }">Перейти</router-link>
          <router-link class="btn btn-sm btn-primary product-item__link" :to="{ name: 'product-edit', params: { id: product.id } }">Редактировать</router-link>
          <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger product-item__link">Удалить</button>
        </div>
      </div>
    </div>
    <div v-else>
      Товары не найдены
    </div>

    <div class="pagination mt-4" v-if="!loading">
      <div>
        <button class="btn btn-secondary" v-if="links.next" @click="getPage(links.next)">След. страница</button>
      </div>
      <div>
        <button class="btn btn-secondary" v-if="links.prev" @click="getPage(links.prev)">Пред. страница</button>
      </div>
    </div>
  </div>
</template>
<style>

</style>

<script>
import axios from 'axios';

export default {
  name: 'ProductList',
  data(){
    return {
      loading: true,
      products: [],
      links: [],
      query: ''
    }
  },
  mounted() {
      this.getProducts();
  },
  methods: {
    getProducts(){
      axios.get('http://api.local/api/products')
          .then(response => {
            this.loading = false;
            this.products = response.data.data;
            this.links = response.data.links;
          });
    },
    search(){
        if(this.query.length > 2){
          this.loading = true;
          axios.get('http://api.local/api/products?name=' + this.query)
              .then(response => {
                this.loading = false;
                this.products = response.data.data;
                this.links = response.data.links;
              });
        }
    },
    deleteProduct(id){
      axios.delete('http://api.local/api/products/' + id).then(() => {
        this.getProducts();
      });
    },
    getPage(link){
      this.loading = true;
      axios.get(link)
          .then(response => {
            this.loading = false;
            this.products = response.data.data;
            this.links = response.data.links;
          });
    }
  }
}
</script>