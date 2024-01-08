//Pinia
import { Pinia, Store, createPinia, getActivePinia } from "pinia";
import { createPersistedState } from 'pinia-plugin-persistedstate';

//available stores
import { authStore } from "../store/auth.store";
import { userStore } from "../store/user.store";

const pinia = createPinia();

pinia.use(
  createPersistedState({
    auto: true,
    storage: sessionStorage
  })
);

export default pinia;
