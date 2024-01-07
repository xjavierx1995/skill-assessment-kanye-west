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
      <div class="hidden sm:flex justify-content-end align-items-center gap-2 w-full">
        <span class="font-bold white-space-nowrap">{{ user?.name }}</span>
        <Avatar image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8Oh2pOkK3_kY4SEner5CgepYCgOKeRKg31A&usqp=CAU" shape="circle" />
      </div>
    </template>
  </Toolbar>
  <div class="m-3">
    <router-view />
  </div>
</template>

<script setup lang="ts">
import Toolbar from 'primevue/toolbar';
import sidebarVue from './sidebar.vue';
import Avatar from 'primevue/avatar';
import { userStore } from '../../store/user.store';

const { user } = userStore()
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
