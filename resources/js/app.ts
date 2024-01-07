// app.ts
import './bootstrap';

import {createApp} from 'vue';
import App from './App.vue';

//Router
import router from './router';

//Pinia
import pinia from './plugins/pinia';


createApp(App).use(pinia).use(router).mount("#app");
