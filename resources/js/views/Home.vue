<template>
  How To Install Vue 3 in Laravel 9 with Vite - TechvBlog




  <div class="flex flex-column md:flex-row md:justify-content-between row-gap-3">
      <Button type="button" label="Button 1"></Button>
      <Button type="button" label="Button 2" severity="secondary"></Button>
      <Button type="button" label="Button 3" severity="help"></Button>
  </div>


<i class="pi pi-check"></i>
<i class="pi pi-times"></i>
<span class="pi pi-search"></span>
<span class="pi pi-user"></span>
  <Button @click="goFavorites" label="Ir a favoritos"></Button>
</template>
<script lang="ts" setup>
import router from '../router';
import Button from "primevue/button"


  function goFavorites() {
    router.push('/favorites');
  }
</script>
