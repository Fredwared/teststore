<template>
  <div>
    <h2>Новый товар</h2>
    <div v-if="errors">
      <ul>
        <li v-for="(value, name, index) in errors" :key="index">
          {{ name }}: {{ value[0] }}
        </li>
      </ul>
    </div>
    <form @submit.prevent="createProduct">
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
        <span>Создать</span>
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'ProductCreate',
  data(){
    return {
      id: false,
      product: {
        name: '',
        description: '',
        price: 0,
        weight: '',
        color: ''
      },
      errors: false
    }
  },
  created() {
    this.id = this.$route.params.id;
  },
  methods: {
    createProduct(){
      axios.post('http://api.local/api/products/', this.product)
          .then(response => {
            this.product = response.data.data;
            this.$router.push({name: 'products-list'})
          })
          .catch(exception => {
            this.errors = exception.response.data.errors;
          });
    }
  }
}
</script>