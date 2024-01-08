<template>
  <Card style="width: 25em: margin-top: 7.5em;">
    <template #header>
      <!-- <img alt="user header" src="https://www.mansworldindia.com/wp-content/uploads/2022/05/Kanye-West-Donda.jpg" /> -->
    </template>
    <template #title> Init to joy!! </template>
    <template #content>
      <div class="card flex flex-column justify-content-center gap-2">

          <div class="flex flex-column gap-2 justify-content-center">
            <label for="email" style="color: white;">Email</label>
            <InputText id="email" v-model="email" type="text" :class="{ 'p-invalid': emailErrors.length > 0 }"/>
            <small class="p-error" id="text-error">{{  emailErrors[0] || '&nbsp;' }}</small>
          </div>

          <div class="flex gap-2 flex-column justify-content-center">
            <label for="pass" style="color: white;">Password</label>
            <Password toggleMask id="pass" v-model="password" />
            <small class="p-error" id="text-error">{{  passErrors[0] || '&nbsp;' }}</small>
          </div>
        </div>
    </template>
    <template #footer>
      <div class="flex justify-content-between">
        <Button icon="pi pi-user" label="register" @click.stop="router.push('/auth/register')" />
        <Button :loading="loading.isLoading.value" :disabled="!formValidated" icon="pi pi-user" label="Login" @click="login" />
      </div>
    </template>
  </Card>
</template>
<script setup lang="ts">
import { authStore } from '../../store/auth.store';
import { Ref, computed, ref, watch, onMounted } from 'vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import router from '../../router';
import { loadingStore } from '../../store/loading.store';
import { storeToRefs } from 'pinia';

const store = authStore();
const loading = storeToRefs(loadingStore());

const email = ref('');
const password = ref('');
const emailErrors: Ref<string[]> = ref([]);
const passErrors: Ref<string[]> = ref([]);

const formValidated = computed(() =>
  !!email.value &&
  !!password.value &&
  emailErrors.value.length === 0 &&
  passErrors.value.length === 0)

function login() {
  store.login(email.value, password.value);
}

watch(email, async (newEmail, oldEmail) => {
  if (newEmail === '') {
    emailErrors.value = ['Email field is required'];
    return;
  }
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regexEmail.test(newEmail)) {
    emailErrors.value.push('Write a valid email');
    return
  }
  emailErrors.value = [];
})

watch(password, async (newPass, oldPass) => {
  if (newPass === '') {
    passErrors.value = ['Password field is required'];
    return;
  }

  passErrors.value = [];
})
</script>
<style scoped>
.p-card {
  background-color: #6f43e085;
  color: white !important;
}

::v-deep .p-inputtext {
  width: -webkit-fill-available;
}
</style>
