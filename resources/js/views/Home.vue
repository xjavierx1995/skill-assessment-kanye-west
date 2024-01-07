<template>
  How To Install Vue 3 in Laravel 9 with Vite - TechvBlog

  <button type="button" @click="goFavorites">Ir a favoritos</button>
</template>
<script lang="ts" setup>
import router from '../router';


  function goFavorites() {
    router.push('/favorites');
  }
</script>
