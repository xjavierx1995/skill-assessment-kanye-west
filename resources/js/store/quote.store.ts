import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { BaseResponse } from "../interfaces/BaseResponse.interface";
import { Favorites } from "../interfaces/Favorites.interface";
import { userStore } from "./user.store";

export const quoteStore = defineStore('quote', {
  state: (): { quotes: string[], favorites: Favorites[] } => ({
    quotes: [],
    favorites: []
  }),
  getters: {
    isFavorite: (state) => {
      return (quote) => !!state.favorites.find(e => e.quote === quote);
    }
  },
  actions: {
    async getQuotes() {
      const { data } = await axios.get<BaseResponse<string[]>>(`/quotes?amount?${5}`);
      this.quotes = data.data;
    },
    async getFavorites() {
      try {
        const { user } = userStore();
        const { data } = await axios.get<BaseResponse<Favorites[]>>(`/my-favorites/${user?.id}`);
        this.favorites = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async addFavorite(quote: string) {
      try {
        const { user } = userStore();
        await axios.post<BaseResponse<Favorites>>(`/add-favorite/${user?.id}`, { quote });
        this.getFavorites();
      } catch (error) {
        console.log(error);
      }
    },
    async deleteFavorite(favoriteId) {
      try {
        const { user } = userStore();
        await axios.delete<BaseResponse<null>>(`/delete-favorite/${favoriteId}`);
        if (!user?.isAdmin) {
          this.getFavorites();
        }
      } catch (error) {
        console.log(error);
      }
    }
  },
})
