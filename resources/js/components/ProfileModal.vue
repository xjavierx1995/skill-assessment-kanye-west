<template>
  <div class="card flex justify-content-center">
    <div @click="visible = true" :class="{ 'flex-row-reverse ': invertAvatar, 'hidden': hideSm, 'flex': !hideSm }"
      class="cursor-pointer sm:flex justify-content-end align-items-center gap-2 w-full">
      <span class="font-bold white-space-nowrap">{{ userRef.user.value?.name }}</span>
      <Avatar image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8Oh2pOkK3_kY4SEner5CgepYCgOKeRKg31A&usqp=CAU"
        shape="circle" />
    </div>
    <Dialog v-model:visible="visible" modal header="Update profile" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
      <Card style="width: 25em: margin-top: 7.5em;">
        <template #header>
          <div class="flex justify-content-center">
            <Avatar
              image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8Oh2pOkK3_kY4SEner5CgepYCgOKeRKg31A&usqp=CAU"
              shape="circle" />
          </div>
        </template>
        <template #content>
          <div class="card flex flex-column justify-content-center gap-2">

            <div class="flex flex-column gap-2 justify-content-center">
              <label for="email" style="color: white;">Email</label>
              <InputText id="email" :value="user?.email" readonly />
            </div>

            <div class="flex flex-column gap-2 justify-content-center">
              <label for="name" style="color: white;">Name</label>
              <InputText id="name" v-model="name" type="text" :class="{ 'p-invalid': nameErrors.length > 0 }" />
              <small class="p-error" id="text-error">{{ nameErrors[0] || '&nbsp;' }}</small>
            </div>
          </div>
        </template>
        <template #footer>
          <div class="flex justify-content-between">
            <Button icon="pi pi-pencil" label="Update" @click="update" :disabled="!formValidated" />
          </div>
        </template>
      </Card>
    </Dialog>
  </div>
</template>

<script setup lang="ts">
import Dialog from 'primevue/dialog';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import { Ref, computed, ref, watch } from "vue";
import { userStore } from '../store/user.store';
import { storeToRefs } from 'pinia';
defineProps<{
  invertAvatar?: boolean,
  hideSm?: boolean
}>();

const { user, updateProfile } = userStore();
const userRef = storeToRefs(userStore());
const visible = ref(false);
const name = ref(user?.name);
const nameErrors: Ref<string[]> = ref([]);

const formValidated = computed(() => !!name.value && nameErrors.value.length === 0);

function update() {
  updateProfile(name.value!);
}

watch(name, async (newName, oldPass) => {
  if (newName === '') {
    nameErrors.value = ['Name field is required'];
    return;
  }

  nameErrors.value = [];
})
</script>
