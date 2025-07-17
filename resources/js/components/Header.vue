<template>
  <header class="flex justify-between items-center p-4 bg-gray-100 shadow">
    <h1 class="text-2xl font-semibold"> {{ leftText }}</h1>
    <div v-if="page === 'logado'" class="flex gap-5">
      <BotoesHeader @click="perfil" button-text="Perfil"/>
      <BotoesHeader @click="logout" button-text="Sair"/>
    </div>
    <div v-else>
      <BotoesHeader button-text="Voltar" @click="backToHome"/>
    </div>
  </header>
</template>

<script lang="ts">
import BotoesHeader from "../components/BotoesHeader.vue";
import axios, {all} from "axios";
import {useFlashStore} from "../stores/flash";

export default {
  name: "Header",
  components: {BotoesHeader},
  data() {
    return {
      page: null as string
    }
  },

  props: {
    leftText: {
      type: String,
      required: false
    },
  },

  mounted() {
    this.page = window.location.href.split('/').pop();
  },

  methods: {
    perfil() {
      return window.location.href = '/perfil'
    },

    async logout() {
      const flash = useFlashStore();
      try {
        const response = await axios.get('http://localhost:8000/logout', {withCredentials: true})
        flash.set(response.data.message, 'success');
        window.location.href = '/login'
      } catch (e) {
        (e.response.data.message) ? flash.set(e.response.data.message) : console.log(`Erro ao deslogar ${e}`)
      }
    },

    backToHome() {
      return window.location.href = '/logado'
    }
  },
}
</script>