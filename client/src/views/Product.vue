<template>
  <div>
      <h2>{{ product.name }}</h2>
      <p>{{ product.description }}</p>
      <ul>
        <li v-if="product.color">Цвет :{{ product.color }}</li>
        <li v-if="product.weight">Вес: {{ product.weight }}</li>
      </ul>
  </div>
</template>

<script>
// import axios from "axios";

import axios from "axios";

export default {
  name: 'Product',
  data() {
    return {
      id: this.$route.params.id,
      product: []
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
  }
}
</script>