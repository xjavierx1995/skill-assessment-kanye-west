<template>
  <Card style="width: 25em: margin-top: 7.5em;">
    <template #header>
      <!-- <img alt="user header" src="https://www.mansworldindia.com/wp-content/uploads/2022/05/Kanye-West-Donda.jpg" /> -->
    </template>
    <template #title> Register </template>
    <template #content>
      <div class="card flex flex-column justify-content-center gap-2">

          <div class="flex flex-column gap-2 justify-content-center">
            <label for="email" style="color: white;">Email</label>
            <InputText id="email" v-model="email" type="text" :class="{ 'p-invalid': emailErrors.length > 0 }"/>
            <small class="p-error" id="text-error">{{  emailErrors[0] || '&nbsp;' }}</small>
          </div>

          <div class="flex flex-column gap-2 justify-content-center">
            <label for="name" style="color: white;">Name</label>
            <InputText id="name" v-model="name" type="text" :class="{ 'p-invalid': nameErrors.length > 0 }"/>
            <small class="p-error" id="text-error">{{  nameErrors[0] || '&nbsp;' }}</small>
          </div>

          <div class="flex gap-2 flex-column justify-content-center">
            <label for="pass" style="color: white;">Password</label>
            <Password toggleMask id="pass" v-model="password" />
            <small class="p-error" id="text-error">{{  passErrors[0] || '&nbsp;' }}</small>
          </div>

          <div class="flex gap-2 flex-column justify-content-center">
            <label for="c_pass" style="color: white;">Confirm Password</label>
            <Password toggleMask id="c_pass" v-model="cPassword" />
            <small class="p-error" id="text-error">{{  cPassErrors[0] || '&nbsp;' }}</small>
          </div>
        </div>
    </template>
    <template #footer>
      <div class="flex justify-content-between">
        <Button :disabled="!formValidated" icon="pi pi-user" label="Login" @click="router.push('/auth/login')"/>
        <Button icon="pi pi-user" label="register" @click="register"/>
      </div>
    </template>
  </Card>
</template>
<script setup lang="ts">
import { authStore } from '../../store/auth.store';
import { Ref, computed, ref, watch } from 'vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import router from '../../router';

const store = authStore();

const email = ref('');
const name = ref('');
const password = ref('');
const cPassword = ref('');
const emailErrors: Ref<string[]> = ref([]);
const nameErrors: Ref<string[]> = ref([]);
const passErrors: Ref<string[]> = ref([]);
const cPassErrors: Ref<string[]> = ref([]);

const formValidated = computed(() =>
  !!email.value &&
  !!name.value &&
  !!password.value &&
  !!cPassword.value &&
  nameErrors.value.length === 0 &&
  cPassErrors.value.length === 0 &&
  emailErrors.value.length === 0 &&
  passErrors.value.length === 0)

function register() {
  store.register(name.value, email.value, password.value, cPassword.value);
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

watch(cPassword, async (newPass, oldPass) => {
  if (newPass === '') {
    cPassErrors.value = ['Confirm Password field is required'];
    return;
  }

  if (newPass !== password.value) {
    cPassErrors.value = ['Passwords are not equal'];
    return;
  }

  cPassErrors.value = [];
})

watch(name, async (newName, oldPass) => {
  if (newName === '') {
    nameErrors.value = ['Name field is required'];
    return;
  }

  nameErrors.value = [];
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
