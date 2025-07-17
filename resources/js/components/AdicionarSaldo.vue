<template>
  <section class="flex flex-col p-6 max-w-3xl mx-auto items-center">
    <button
        @click="showMenuScreen"
        class="bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-6 rounded shadow-md mb-8 w-full max-w-xs text-center">
      Adicionar Saldo
    </button>

    <div v-if="showMenu" class="w-full flex flex-col gap-4">
      <div class="flex flex-col md:flex-row md:items-end gap-6">
        <div class="w-full md:w-1/2">
          <label class="block text-gray-700 font-medium mb-2">Usuário</label>
          <select
              v-model="selectedUserIdForMoney"
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option
                v-for="(user, index) in userList"
                :key="index">
              {{ user.name }} | {{ user.id }}
            </option>
          </select>
        </div>

        <div class="w-full md:w-1/2">
          <label class="block text-gray-700 font-medium mb-2">Quantidade a adicionar</label>
          <input type="number"
                 v-model="quantityMoneyToAdd"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400">
        </div>
      </div>

      <button type="submit"
              @click="addMoneyToUser(selectedUserIdForMoney.toLocaleString().slice(-1))"
              class="bg-green-500 hover:bg-green-600 transition text-white font-semibold py-2 px-6 rounded-lg shadow-md w-full md:w-max mx-auto">
        Adicionar
      </button>
    </div>
  </section>
</template>

<script lang="ts">
import {UserListInterface} from "../Interfaces/UserListInterface";
import {useFlashStore} from "../stores/flash";
import axios from "axios";

export default {
  name: 'AdicionarSaldo',
  data() {
    return {
      showMenu: false as boolean,
      userList: [] as UserListInterface[],
      selectedUserIdForMoney: null as number,
      quantityMoneyToAdd: null as number
    }
  },

  async mounted(): Promise<UserListInterface> {
    const response = await axios.get('http://localhost:8000/api/users', {withCredentials: true});
    this.userList = response.data;
    return this.userList;
  },

  methods: {
    showMenuScreen() {
      this.showMenu = !this.showMenu;
    },

    async addMoneyToUser(id: any) {
      const flash = useFlashStore();
      try {
        const response = await axios.put(`http://localhost:8000/api/perfil/${id}`, {
          "money": this.quantityMoneyToAdd
        }, {withCredentials: true});
        flash.set(response.data.message, 'success');
        setInterval(function () {
          window.location.href = '/logado';
        }, 2000)
      } catch (e) {
        (e.response?.data.message) ? flash.set(e.response.data.message, 'error') : console.log(`Falha ao adicionar saldo em usuário ${e}`)
      }
    }
  }
}
</script>