<template>
  <div>
    this is favorite page

    <ul v-if="store.favorites.length > 0">
      <li v-for="item in store.favorites">
        {{ item.quote }}
      </li>
    </ul>
  </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import { userStore } from '../store/user.store';

const store = userStore();

onMounted(() => {
  store.getFavorites();
})
</script>
