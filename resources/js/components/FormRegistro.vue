<template>
  <section class="flex items-center justify-center min-h-screen p-4">
    <form @submit.prevent="registerAccount" class="w-full max-w-xl bg-white rounded-3xl shadow-2xl p-10 space-y-8">
      <h2 class="text-4xl font-extrabold text-center text-gray-800">Crie sua conta</h2>

      <div class="space-y-6">
        <div class="flex flex-col">
          <label for="name" class="mb-1 font-semibold text-gray-700">Nome</label>
          <input
              v-model="name"
              id="name"
              type="text"
              required
              placeholder="Seu nome completo"
              class="border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-lg"
          >
        </div>

        <div class="flex flex-col">
          <label for="email" class="mb-1 font-semibold text-gray-700">Email</label>
          <input
              v-model="email"
              id="email"
              type="email"
              required
              placeholder="seuemail@exemplo.com"
              class="border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-lg"
          >
        </div>

        <div class="flex flex-col">
          <label for="password" class="mb-1 font-semibold text-gray-700">Senha</label>
          <input
              v-model="password"
              id="password"
              type="password"
              required
              placeholder="********"
              class="border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-lg"
          >
        </div>

        <div class="flex flex-col">
          <label for="repeatedPassword" class="mb-1 font-semibold text-gray-700">Repita sua senha</label>
          <input
              v-model="repeatedPassword"
              id="repeatedPassword"
              type="password"
              required
              placeholder="********"
              class="border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-lg"
          >
        </div>
      </div>

      <button
          type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-2xl py-4 transition-colors shadow-md hover:shadow-lg"
      >
        Registrar
      </button>
    </form>
  </section>
</template>


<script lang="ts">
import axios from "axios";
import {useFlashStore} from "../stores/flash";

export default {
  name: "FormRegistro",
  data() {
    return {
      name: null as string,
      email: null as string,
      password: null as string,
      repeatedPassword: null as string
    }
  },

  methods: {
    async registerAccount() {
      const flash = useFlashStore();
      try {
        const response = await axios.post('http://localhost:8000/api/register', {
              "name": this.name,
              "email": this.email,
              "password": this.password,
            },
            {withCredentials: true})
        flash.set(response.data.message, 'success')
      } catch (e) {
        (e.response.data.message) ? flash.set(e.response.data.message, 'error') : console.log(`Falha ao registrar sua conta ${e}`);
      }
    }
  }
}
</script>