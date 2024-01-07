<template>
  <div class="grid">
    <div class="col" v-for="(item, index) in store.quotes" :key="index">
      <QuoteCard :quote-text="item"/>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { onMounted } from 'vue';
import { quoteStore } from '../store/quote.store';
import QuoteCard from '../components/QuoteCard.vue'
const store = quoteStore();

onMounted(() => {
  store.getQuotes();
})
</script>
