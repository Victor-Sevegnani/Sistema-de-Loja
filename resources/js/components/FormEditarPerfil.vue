<template>
  <section class="flex justify-center items-center px-4 py-10">
    <div
        class="flex flex-col gap-5 w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-2xl shadow-2xl p-6 sm:p-8 md:p-10 transition-all bg-gray-50">

      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-8 text-gray-800">
        Editar Perfil
      </h2>

      <form @submit.prevent="updateProfile(this.perfil['id'])" class="space-y-6">

        <div>
          <label for="nome" class="block text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">Nome</label>
          <input v-model="newName" :placeholder="perfil['actualName']" id="nome" type="text"
                 class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:ring-2 focus:ring-amber-400 transition text-sm sm:text-base"
                 required/>
        </div>

        <div>
          <label for="email"
                 class="block text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">Email</label>
          <input v-model="newEmail" :placeholder="perfil['actualEmail']" id="email" type="email"
                 class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:ring-2 focus:ring-amber-400 transition text-sm sm:text-base"
                 required/>
        </div>

        <div>
          <label for="password"
                 class="block text-xs sm:text-sm md:text-base font-semibold text-gray-700 mb-1">Senha</label>
          <input v-model="newPassword" :placeholder="perfil['actualPassword']" id="password" type="password"
                 class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:ring-2 focus:ring-amber-400 transition text-sm sm:text-base"
                 required/>
        </div>

        <div>
          <button type="submit"
                  class="w-full bg-amber-400 hover:bg-amber-500 text-white font-bold py-3 rounded-lg shadow transition active:scale-95 text-sm sm:text-base">
            Atualizar Perfil
          </button>
        </div>
      </form>

      <div class="flex gap-5">
        <button type="submit"
                @click="showConfirmationScreen"
                class="w-full bg-red-400 hover:bg-red-500 text-white font-bold py-3 rounded-lg shadow transition active:scale-95 text-sm sm:text-base"
        >Deletar perfil
        </button>
        <div v-if="showConfirm">
          <button type="submit"
                  @click="deleteProfile"
                  class="w-full bg-red-400 hover:bg-red-500 text-white font-bold py-3 rounded-lg shadow transition active:scale-95 text-sm sm:text-base">
            Confirmar exclusão de perfil
          </button>
        </div>
      </div>
    </div>
  </section>
</template>


<script lang="ts">
import axios from "axios";
import {useFlashStore} from '../stores/flash';
import {UserInterface} from '../Interfaces/UserInterface';

export default {
  name: "FormEditarPerfil",

  data() {
    return {
      perfil: [] as UserInterface[],
      confirmExcludeProfile: null,
      showConfirm: false,
      newName: null,
      newEmail: null,
      newPassword: null,
    }
  },

  async mounted() {
    await axios.get('http://localhost:8000/api/perfil', {withCredentials: true})
        .then((response) => {
          this.perfil['actualName'] = response.data.name;
          this.perfil['actualEmail'] = response.data.email;
          this.perfil['actualPassword'] = response.data.password;
          this.perfil['id'] = response.data.id;
        })
  },

  methods: {
    async updateProfile(id: number) {
      const flash = useFlashStore();
      try {
        const response = await axios.put(`http://localhost:8000/api/perfil/${id}`, {
          "name": this.newName,
          "email": this.newEmail,
          "password": this.newPassword,
        }, {withCredentials: true,})
        flash.set(response.data.message, 'success')
      } catch (e) {
        (e.response.data.message) ? flash.set(e.response.data.message) : console.log(e);
      }
    },

    showConfirmationScreen() {
      this.showConfirm = !this.showConfirm;
    },
    async deleteProfile() {
      const flash = useFlashStore();
      try {
        const response = await axios.delete(`http://localhost:8000/api/perfil/${this.id}`)
        flash.set(response.data.message, 'success')
        setTimeout(function () {
          return window.location.href = '/'
        }, 2000)
      } catch (e) {

      }
    }
  }
}
</script>
