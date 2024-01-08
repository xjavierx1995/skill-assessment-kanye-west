<template>
  <div class="card flex justify-content-center">
      <div @click="visible = true" :class="{ 'flex-row-reverse ': invertAvatar }" class="cursor-pointer hidden sm:flex justify-content-end align-items-center gap-2 w-full">
        <span class="font-bold white-space-nowrap">{{ user?.name }}</span>
        <Avatar image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8Oh2pOkK3_kY4SEner5CgepYCgOKeRKg31A&usqp=CAU" shape="circle" />
      </div>
      <Dialog v-model:visible="visible" modal header="Header" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
          <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
      </Dialog>
  </div>
</template>

<script setup lang="ts">
import Dialog from 'primevue/dialog';
import Avatar from 'primevue/avatar';
import { ref } from "vue";
import { userStore } from '../store/user.store';

const { user } = userStore();
const visible = ref(false);
defineProps<{
  invertAvatar?: boolean
}>()
</script>
