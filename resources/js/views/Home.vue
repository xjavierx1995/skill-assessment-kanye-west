<template>
  <div class="flex align-items-center justify-content-between mb-1">
    <h3>Best 5 quotes of Ye</h3>
    <Button icon="pi pi-refresh" :loading="loading.isLoading.value" rounded @click="store.getQuotes()" />
  </div>
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
import Button from 'primevue/button';
import { loadingStore } from '../store/loading.store';
import { storeToRefs } from 'pinia';

const store = quoteStore();
const loading = storeToRefs(loadingStore());
onMounted(() => {
  store.getQuotes();
})
</script>
