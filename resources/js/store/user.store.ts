import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { User, UserStore } from "../interfaces/UserStore.interface";
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { Favorites } from "../interfaces/Favorites.interface";

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
    }
  },
})
