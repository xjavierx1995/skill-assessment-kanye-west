import { defineStore } from "pinia"

export const loadingStore = defineStore('loading', {
  state: (): { isLoading: boolean } => ({
    isLoading: false
  }),
  getters: {

  },
  actions: {

  },
})
