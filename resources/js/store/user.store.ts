import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { UserStore } from "../interfaces/UserStore.interface";
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { Favorites } from "../interfaces/Favorites.interface";

export const userStore = defineStore('user', {
  state: (): UserStore => ({
    user: undefined,
    favorites: []
  }),
  getters: {
    isLogged(): boolean {
      return !!this.user;
    }
  },
  actions: {
    async getFavorites() {
      const { data } = await axios.get<BaseResponse<Favorites[]>>(`/my-favorites/${this.user?.id}`);
      this.favorites = data.data;
    }
  },
})
