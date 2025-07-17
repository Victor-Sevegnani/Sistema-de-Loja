<template>
  <section class="flex items-center justify-center min-h-screen p-4">
    <form @submit.prevent="login" class="w-full max-w-xl bg-white rounded-3xl shadow-2xl p-10 space-y-8">
      <h2 class="text-4xl font-extrabold text-center text-gray-800">Faça seu login</h2>

      <div class="space-y-6">
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
      </div>

      <button
          type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-2xl py-4 transition-colors shadow-md hover:shadow-lg"
      >
        Entrar
      </button>
    </form>
  </section>
</template>



<script lang="ts">
import axios from 'axios';
import {useFlashStore} from '../stores/flash';

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    async login() {
      const flash = useFlashStore();
      try {
        await axios.get("http://localhost:8000/sanctum/csrf-cookie", {withCredentials: true});
        const response = await axios.post("http://localhost:8000/login", {
          email: this.email,
          password: this.password,
        }, {
          withCredentials: true
        });

        flash.set(response.data.message, 'success');
        setTimeout(() => {
          window.location.href = '/logado';
        }, 2000);

      } catch (error) {
        console.error("Erro no login:", error.response.data);
        if (error.response.data.message) {
          flash.set(error.response.data.message, 'error');
        }
      }
    }
  }
}
</script>
