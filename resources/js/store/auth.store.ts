import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { AuthResponse, AuthStore } from "../interfaces/Auth.interface";
import { userStore } from "./user.store";
import router from "../router";

export const authStore = defineStore('auth', {
  state: (): AuthStore => ({
    access_token: ''
  }),
  getters: {

  },
  actions: {
    async login(email: string, password: string) {
      const storeUser = userStore();
      const { data } = await axios.post<BaseResponse<AuthResponse>>('/login', { email, password });

      if (!data.data.user.canLogin) {
        console.log('no se puede logear');
        return;
      }
      this.access_token = data.data.token;
      storeUser.user = data.data.user;
      router.push('/home');
    }
  },
})
