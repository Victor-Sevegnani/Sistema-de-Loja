<template>
  <section class="flex flex-col p-6 max-w-3xl mx-auto items-center">
    <button
        @click="showMenu"
        class="bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-4 rounded shadow mb-6 w-max">
      Comprar Produto
    </button>

    <ul v-if="ShowMenu" class="w-full max-w-md">
      <li class="flex flex-col sm:flex-row gap-4 sm:gap-5 items-center">
        <select
            v-model="selectedProduct"
            class="bg-amber-200 border border-amber-400 font-semibold py-2 px-3 rounded-md w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-amber-400">
          <option
              v-for="(product, index) in products"
              :key="index"
              :value="product.product">
            {{ product.product }}
          </option>
        </select>

        <input v-model.number="quantity" placeholder="Quantidade" type="number" min="1"
               class="bg-amber-200 border border-amber-400 font-semibold py-2 px-3 rounded-md w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-amber-400"
               required>

        <button
            @click="buyItem"
            class="bg-green-500 hover:bg-green-600 transition text-white font-semibold px-4 py-2 rounded-md shadow w-full sm:w-auto">
          Confirmar compra
        </button>
      </li>
    </ul>
  </section>
</template>

<script lang="ts">
import axios from "axios";
import {useFlashStore} from "../stores/flash";
import {Produto} from "../Interfaces/Produto";

export default {
  name: 'ComprarProduto',
  data() {
    return {
      ShowMenu: false as boolean,
      products: [] as Produto[],
      selectedProduct: null as Produto['product'],
      quantity: 1 as Produto['quantity'],
    }
  },


  methods: {
    async showMenu() {
      this.ShowMenu = !this.ShowMenu;
      const response = await axios.get('http://localhost:8000/api/produtos', {
        withCredentials: true,
      });
      return this.products = response.data;
    },

    async buyItem()  {
      const flash = useFlashStore();

      if (!this.selectedProduct) {
        flash.set('Selecione um produto.', 'error');
        return;
      }

      if (!this.quantity || this.quantity <= 0) {
        flash.set('Informe uma quantidade válida.', 'error');
        return;
      }

      try {
        const response = await axios.post('http://localhost:8000/api/comprar', {
          product: this.selectedProduct,
          quantity: this.quantity,
        }, {withCredentials: true});

        setInterval(function () {
          flash.set(response.data.message, 'success');
        }, 2000);

        window.location.href = '/logado';
      } catch (e) {
        flash.set(e.response.data.error, 'error');
      }
    }
  }
}
</script>
