<template>
  <Toolbar>
    <template #start>
      <sidebarVue />
      Welcome
    </template>

    <template #center>

    </template>

    <template #end>

    </template>
  </Toolbar>
  <div class="m-3">
    <router-view />
  </div>
</template>

<script setup lang="ts">
import Toolbar from 'primevue/toolbar';
import sidebarVue from './sidebar.vue';
</script>

<style scoped>
.layout-auth {
  display: flex;
  justify-content: center;
  align-items: center;
}

.p-toolbar {
  color: white;
  border: 0;
  background: #6f43e085;
  border-radius: 0;

  margin-bottom: 50px;

  font-size: 1.2em;
  font-weight: bold;
}
</style>
