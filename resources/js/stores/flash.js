import {defineStore} from "pinia";

export const useFlashStore = defineStore('flash', {
    state: () => ({
        message: null,
        type: 'success'
    }),

    actions: {
        set(message, type) {
            this.message = message;
            this.type = type;
            setTimeout(() => this.message = null, 3000)
        }
    }
})