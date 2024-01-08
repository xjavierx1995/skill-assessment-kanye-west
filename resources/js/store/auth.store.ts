import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { AuthResponse, AuthStore } from "../interfaces/Auth.interface";
import { userStore } from "./user.store";
import router from "../router";
import { quoteStore } from "./quote.store";

export const authStore = defineStore('auth', {
  state: (): AuthStore => ({
    access_token: ''
  }),
  getters: {

  },
  actions: {
    async login(email: string, password: string) {
      try {


        const storeUser = userStore();
        const { data } = await axios.post<BaseResponse<AuthResponse>>('/login', { email, password });

        if (!data.data.user.canLogin) {
          console.log('no se puede logear');
          return;
        }

        this.access_token = data.data.token;
        storeUser.user = data.data.user;

        data.data.user.isAdmin ? router.push('/users') : router.push('/home');
      } catch (error: any) {
        console.log(error.response.data.message);

      }
    },

    async register(name: string, email: string, password: string, c_password: string) {
      try {
        const storeUser = userStore();
        const { data } = await axios.post<BaseResponse<AuthResponse>>('/register', { email, password, name, c_password });

        this.access_token = data.data.token;
        storeUser.user = data.data.user;
        router.push('/home');
      } catch (error: any) {
        console.log(error);

      }
    },
    async logout() {
      sessionStorage.clear();
      userStore().$reset();
      authStore().$reset();
      quoteStore().$reset();
      router.push('/auth/login');
    },
  },
})
