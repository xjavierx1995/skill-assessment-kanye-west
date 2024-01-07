<template>
  <Card style="height: 100%;">
    <template #title>
      <div class="text-right	">
        <Button icon="pi pi-star" rounded text />
      </div>
    </template>
    <template #content>
      <p class="m-0 font-bold font-italic">
        “{{ quoteText }}”
      </p>
    </template>
    <template #footer>
      -Kanye west
    </template>
  </Card>
</template>
<script setup lang="ts">
import Card from 'primevue/card';
import Button from 'primevue/button';

defineProps<{
  quoteText?: string
}>()
</script>
<style scoped>
::v-deep .p-card-body {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
