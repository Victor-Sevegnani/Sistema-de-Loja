<template>
  <section class="p-6 max-w-3xl mx-auto">
    <button
        @click="showMenuScreen"
        class="bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-5 rounded-md shadow-md mb-8 w-full max-w-xs mx-auto block"
    >
      Ver minhas compras
    </button>

    <div v-if="showMenu" class="space-y-4">
      <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <li
            v-for="(order, index) in orders"
            :key="index"
            class="bg-white rounded-lg shadow p-4 border border-gray-200 hover:shadow-lg transition"
        >
          <h3 class="text-lg font-semibold text-amber-600 mb-2 capitalize">
            {{ order.product }}
          </h3>
          <p class="text-gray-700">
            <span class="font-semibold">Quantidade:</span> {{ order.quantity }}
          </p>
          <p class="text-gray-700">
            <span class="font-semibold">Total:</span> R$ {{ order.total.toFixed(2) }}
          </p>
        </li>
      </ul>

      <p v-if="orders.length === 0" class="text-center text-gray-500">
        Você ainda não realizou nenhuma compra.
      </p>
    </div>
  </section>
</template>

<script lang="ts">
import {Compras} from "../Interfaces/Compras";
import axios from "axios";
import {useFlashStore} from "../stores/flash";

export default {
  name: 'VerCompras',

  data() {
    return {
      orders: [] as Compras[],
      showMenu: false as boolean
    }
  },

  async mounted() {
    const flash = useFlashStore();
    try {
      const response = await axios.get('http://localhost:8000/api/perfil', {withCredentials: true});
      const userData = response.data;

      this.orders = userData.orders ? JSON.parse(userData.orders) : [];

    } catch (e) {
      (e.response?.data?.message) ? flash.set(e.response.data.message, 'error') : console.log(e);
    }
  },


  methods: {
    showMenuScreen() {
      this.showMenu = !this.showMenu;
    }
  }
}
</script>
