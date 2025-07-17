<template>
  <section class="flex flex-col p-6 max-w-3xl mx-auto items-center">
    <button
        @click="showMenu"
        class="bg-amber-400 hover:bg-amber-500 transition-colors text-white font-semibold py-2 px-4 rounded-md shadow mb-8 w-max"
    >
      Registrar Produto
    </button>

    <div v-if="open" class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
      <form @submit.prevent="registerProduct" class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="flex flex-col">
            <label for="product" class="mb-2 font-semibold text-gray-700">Produto</label>
            <input
                v-model="product"
                id="product"
                type="text"
                required
                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                placeholder="Nome do produto"
            />
          </div>

          <div class="flex flex-col">
            <label for="type" class="mb-2 font-semibold text-gray-700">Tipo</label>
            <input
                v-model="typeOfProduct"
                id="type"
                type="text"
                required
                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                placeholder="Tipo do produto"
            />
          </div>

          <div class="flex flex-col">
            <label for="price" class="mb-2 font-semibold text-gray-700">Preço (R$)</label>
            <input
                v-model="priceOfProduct"
                id="price"
                type="number"
                step="0.01"
                min="0"
                required
                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                placeholder="0.00"
            />
          </div>

          <div class="flex flex-col">
            <label for="quantity" class="mb-2 font-semibold text-gray-700">Quantidade</label>
            <input
                v-model="quantityOfProduct"
                id="quantity"
                type="number"
                min="0"
                required
                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400"
                placeholder="0"
            />
          </div>
        </div>

        <div class="flex justify-center">
          <button
              type="submit"
              class="bg-amber-500 hover:bg-amber-600 transition-colors text-white font-semibold py-3 px-8 rounded-lg shadow"
          >
            Salvar
          </button>
        </div>
      </form>
    </div>
  </section>
</template>


<script lang="ts">
import axios from "axios";
import {useFlashStore} from '../stores/flash';

export default {
  name: 'RegistroDeProdutos',
  data() {
    return {
      open: false,
      product: null,
      typeOfProduct: null,
      priceOfProduct: null,
      quantityOfProduct: null
    }
  },
  methods: {
    showMenu() {
      this.open = !this.open;
    },

    async registerProduct() {
      const flash = useFlashStore();
      try {
        const response = await axios.post('http://localhost:8000/api/produtos', {
          product: this.product,
          type: this.typeOfProduct,
          price: this.priceOfProduct,
          quantity: this.quantityOfProduct
        }, {withCredentials: true, withXSRFToken: true});
        setInterval(function () {
          window.location.href = '/logado';
        }, 2000)
        flash.set(response.data.message, 'success')
        console.log(`Sucesso ao salvar o produto ${this.product}`, response.data);
        this.open = false;

      } catch (error) {
        if (error.response && error.response.data && error.response.data.message) {
          flash.set(error.response.data.message, 'error')
        }
        console.log(`Falha ao salvar o produto: ${error}`);
      }
    }
  }
}
</script>
