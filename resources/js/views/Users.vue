<template>
  <div class="card" v-if="user.user?.isAdmin">
    <Accordion :activeIndex="0">
      <AccordionTab v-for="(item, index) in user.usersList" :key="index">
        <template #header>
          <span class="flex align-items-center gap-2 w-full">
            <Avatar image="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIyLTA1L3Y5MzctYWV3LTExMV8xLWtsaGhqdDhxLmpwZw.jpg" shape="circle" />
            <span class="font-bold white-space-nowrap">{{ item.name }}</span>
            <Badge :value="item.favorites?.length" :severity="item.canLogin ? '' : 'danger'" class="ml-auto" />
          </span>
        </template>
        <div class="flex justify-content-end">
          <Button
            @click="item.canLogin ? user.blockUser(item.id) : user.unlockUser(item.id)"
            :label="item.canLogin ? 'Block user' : 'Unlock user'"
            :severity="item.canLogin ? 'danger' : ''"/>
        </div>
        <p class="m-1 font-bold font-italic text-center" v-for="quote in item.favorites"> “{{ quote.quote }}” </p>
      </AccordionTab>

    </Accordion>
  </div>

  <h1 v-else> You are not allowed to see this page 😡🤬 </h1>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import { userStore } from '../store/user.store'
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Badge from 'primevue/badge';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';

const user = userStore();

onMounted(() => {
  user.getUsers();
})
</script>
