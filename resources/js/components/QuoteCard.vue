<template>
  <Card style="height: 100%;">
    <template #title>
      <Button label="Favorito" />
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
