import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { User, UserStore } from "../interfaces/UserStore.interface";
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import ToastEventBus from 'primevue/toasteventbus';

export const userStore = defineStore('user', {
  state: (): UserStore => ({
    user: undefined,
    usersList: []
  }),
  getters: {
    isLogged(): boolean {
      return !!this.user;
    },
  },
  actions: {
    async getUsers() {
      try {
        const { data } =  await axios.get<BaseResponse<User[]>>(`/get-users`);
        this.usersList = data.data
      } catch (error) {
        console.log(error);
      }
    },
    async blockUser(userId) {
      try {
        await axios.put<BaseResponse<User[]>>(`/block-user/${userId}`);
        this.getUsers();
      } catch (error) {
        console.log(error);
      }
    },
    async unlockUser(userId) {
      try {
        await axios.put<BaseResponse<User[]>>(`/unlock-user/${userId}`);
        this.getUsers();
      } catch (error) {
        console.log(error);
      }
    },
    async updateProfile(name: string) {
      try {
        const { data } = await axios.put<BaseResponse<User>>(`/update-user/${this.user?.id}`, { name });
        this.user = data.data;

        ToastEventBus.emit('add', {
          severity: 'success',
          summary: 'Update complete',
          detail: 'User updated successfuly',
          life: 5000
        });
      } catch (error) {
        console.log(error);
      }
    }
  },
})
