<template>
  <Toolbar>
    <template #start>
      Awesome Kanye west page!!
    </template>
  </Toolbar>
  <div class="layout-auth">
    <router-view />
  </div>
</template>
<script setup lang="ts">
import Toolbar from 'primevue/toolbar';

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

  margin-bottom: 100px;

  font-size: 1.2em;
  font-weight: bold;
}
</style>
