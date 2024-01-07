import { defineStore } from "pinia"
import axios from '../plugins/axios';
import { BaseResponse } from "../interfaces/BaseResponse.interface";

export const quoteStore = defineStore('quote', {
  state: (): { quotes: string[] } => ({
    quotes: [],
  }),
  getters: {
  },
  actions: {
    async getQuotes() {
      const { data } = await axios.get<BaseResponse<string[]>>(`/quotes?amount?${5}`);
      this.quotes = data.data;
    }
  },
})
