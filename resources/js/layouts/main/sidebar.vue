<template>
  <div class="card flex justify-content-center">
    <Sidebar v-model:visible="visible" header="Sidebar">
      <template #header>
        <ProfileModalVue :hide-sm="false" :invert-avatar="true"/>
      </template>


      <Menu :model="items">
        <template #item="{ item, props }">
          <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
            <a :href="href" v-bind="props.action" @click="navigate">
              <span :class="item.icon" />
              <span class="ml-2">{{ item.label }}</span>
            </a>
          </router-link>
          <a v-else :href="item.url" :target="item.target" v-bind="props.action">
            <span :class="item.icon" />
            <span class="ml-2">{{ item.label }}</span>
          </a>
        </template>
      </Menu>
    </Sidebar>
    <Button rounded size="small" icon="pi pi-bars" @click="visible = true" />
  </div>
</template>

<script setup lang="ts">
import Sidebar from 'primevue/sidebar';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';
import Menu from 'primevue/menu';
import { onMounted, ref } from "vue";
import router from '../../router/index';
import { userStore } from '../../store/user.store';
import { authStore } from '../../store/auth.store';
import ProfileModalVue from '../../components/ProfileModal.vue';

const { user } = userStore();
const { logout } = authStore();
const visible = ref(false);
const items = ref([
  {
    label: 'Quotes',
    icon: 'pi pi-palette',
    route: '/home'
  },
  {
    label: 'My favorites',
    icon: 'pi pi-link',
    command: () => {
      router.push('/favorites')
    }
  }
]);

onMounted(() => {
  if (user?.isAdmin) {
    items.value = [
      {
        label: 'Users',
        icon: 'pi pi-users',
        route: '/users'
      }
    ]
  }

  items.value.push({
    label: 'Logout',
    icon: 'pi pi-power-off',
    command: () => {
      logout();
    }
  })
})
</script>
