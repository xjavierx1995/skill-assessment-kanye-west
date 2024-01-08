<template>
  <h3>Your favorites quotes of Ye</h3>
  <div class="grid">
    <div class="col" v-for="(item, index) in quote.favorites" :key="index">
      <QuoteCard :quote-text="item.quote"/>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import QuoteCard from '../components/QuoteCard.vue';
import { quoteStore } from '../store/quote.store';
const quote = quoteStore();

onMounted(() => {
  quote.getFavorites();
})
</script>
