// app.ts
import './bootstrap';

import {createApp} from 'vue';
import App from './App.vue';

//Router
import router from './router';

//Pinia
import pinia from './plugins/pinia';

//PrimeVue
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css';
import 'primeicons/primeicons.css';
import 'primeflex/primeflex.css';
import ToastService from 'primevue/toastservice';


createApp(App)
  .use(pinia)
  .use(router)
  .use(ToastService)
  .use(PrimeVue)
  .mount("#app");
