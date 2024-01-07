import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { UserStore } from "../interfaces/UserStore.interface";
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { Favorites } from "../interfaces/Favorites.interface";

export const userStore = defineStore('user', {//TODO: you have to persist this
  state: () => ({
    user: undefined,
    favorites: []
  } as UserStore),
  getters: {
    isLogged(): boolean {
      return !!this.user;
    }
  },
  actions: {
    async getFavorites() {
      const { data } = await axios.get<BaseResponse<Favorites[]>>(`/my-favorites/${this.user?.id}`);
      //   this.moveList = res.data.results;
      this.favorites = data.data;

    }
  },
})
