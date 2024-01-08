<template>
  <Toolbar>
    <template #start>
      <sidebarVue />
      <span class="ml-2">
        Kanye west awesome page!
      </span>
    </template>

    <template #center>

    </template>

    <template #end>
      <ProfileModalVue :hide-sm="true"/>
    </template>
  </Toolbar>
  <div class="m-3">
    <router-view />
  </div>
</template>

<script setup lang="ts">
import Toolbar from 'primevue/toolbar';
import sidebarVue from './sidebar.vue';
import { userStore } from '../../store/user.store';
import ProfileModalVue from '../../components/ProfileModal.vue';

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
