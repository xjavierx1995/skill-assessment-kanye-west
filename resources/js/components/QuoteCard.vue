<template>
  <Card style="height: 100%;">
    <template #title>
      <div class="text-right">
        <Button
          @click="updateFavorites"
          :icon="quote.isFavorite(quoteText) ? 'pi pi-star-fill' :'pi pi-star'"
          rounded text />
      </div>
    </template>
    <template #content>
      <p class="m-0 font-bold font-italic text-center">
        “{{ quoteText }}”
      </p>
    </template>
    <template #footer>
      <div class="text-right">
        -Kanye west
      </div>
    </template>
  </Card>
</template>
<script setup lang="ts">
import Card from 'primevue/card';
import Button from 'primevue/button';
import { quoteStore } from '../store/quote.store';

const props = defineProps<{
  quoteText: string
}>()
const quote = quoteStore();

function updateFavorites() {
  if (quote.isFavorite(props.quoteText)) {
    const favoriteId = quote.favorites.find(e => e.quote === props.quoteText)?.id;
    quote.deleteFavorite(favoriteId);
  }else{
    quote.addFavorite(props.quoteText);
  }
}
</script>
<style scoped>
::v-deep .p-card-body {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
