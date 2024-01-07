<template>
  <div>
    this is login page
  </div>
</template>
<script setup lang="ts">
import { authStore } from '../../store/auth.store';
import { onMounted } from 'vue';
const store = authStore();

onMounted(() => {
    store.login('normal@user.com', '123abc');
})
</script>
