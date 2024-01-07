<template>
  <div class="grid">
    <div class="col" v-for="(item, index) in store.favorites" :key="index">
      <QuoteCard :quote-text="item.quote"/>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import { userStore } from '../store/user.store';
import QuoteCard from '../components/QuoteCard.vue';
const store = userStore();

onMounted(() => {
  store.getFavorites();
})
</script>
