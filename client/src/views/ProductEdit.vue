<template>
  <div>
    <h2>Редактирование товапа</h2>
    <div v-if="errors">
      <ul>
        <li v-for="(value, name, index) in errors" :key="index">
          {{ name }}: {{ value[0] }}
        </li>
      </ul>
    </div>
    <form  @submit.prevent="update">
      <div class="form-group">
        <label for="name">Название товара</label>
        <input type="text" v-model="product.name"/>
      </div>
      <div class="form-group">
        <label for="description">Описание</label>
        <textarea v-model="product.description" id="description" cols="30" rows="10"></textarea>
      </div>
      <div class="form-group">
        <label for="price">Цена</label>
        <input type="number" min="1" v-model="product.price"/>
      </div>
      <div class="form-group">
        <label for="color">Цвет</label>
        <input type="text" v-model="product.color"/>
      </div>
      <div class="form-group">
        <label for="weight">Вес</label>
        <input type="number" min="1" v-model="product.weight"/>
      </div>
      <button>
        <span v-if="loading">Выполняется обновление</span>
        <span v-else>Обновить</span>
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'ProductEdit',
  data(){
    return {
      id: false,
      product: [],
      errors: false,
      loading: false
    }
  },
  created() {
    this.id = this.$route.params.id;
  },
  mounted() {
    axios.get('http://api.local/api/products/' + this.id)
        .then(response => {
          this.product = response.data.data;
        });
  },
  methods: {
    update(){
      this.loading = true;
      axios.put('http://api.local/api/products/' + this.id, this.product)
          .then(response => {
            this.product = response.data.data;
            this.$router.push({name: 'products-list'})
          })
          .catch(exception => {
            this.loading = false;
            this.errors = exception.response.data.errors;
          });
    }
  }
}
</script>