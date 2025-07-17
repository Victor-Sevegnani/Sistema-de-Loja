<template>
  <section class="p-6 max-w-3xl mx-auto">
    <button
        class="bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-4 rounded shadow mb-6"
        @click="getProducts"
    >
      Ver Produtos
    </button>

    <ul v-if="show" class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
      <li
          v-for="(produto, index) in produtos"
          :key="index"
          class="border rounded-lg p-4 shadow hover:shadow-md transition bg-white"
      >
        <h2 class="text-lg font-bold mb-2">{{ produto.product }}</h2>
        <p><span class="font-semibold">Preço:</span> R$ {{ produto.price.toFixed(2) }}</p>
        <p><span class="font-semibold">Estoque:</span> {{ produto.quantity }}</p>
        <p>
          <span class="font-semibold">À venda:</span>
          <span :class="produto.selling ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">
            {{ produto.selling ? 'Sim' : 'Não' }}
          </span>
        </p>
        <div v-if="role === 'Admin'" class="flex flex-col">
          <button
              @click="deleteProduct(produto.id)"
              class="bg-red-500 p-0.5 text-white font-semibold rounded-md mt-2 w-max"
          >
            Deletar Produto
          </button>
          <editar-produto :produto="produto" :editing="true"/>
        </div>
      </li>
    </ul>

    <div v-if="editing" class="flex flex-col items-center">
      <ul class="flex gap-5 pl-20">
        <li>
          <label for="product" class="block mb-1">Produto</label>
          <input id="product" type="text" class="border rounded px-2 py-1" required/>
        </li>
        <li>
          <label for="type" class="block mb-1">Tipo</label>
          <input id="type" type="text" class="border rounded px-2 py-1" required/>
        </li>
        <li>
          <label for="price" class="block mb-1">Preço</label>
          <input id="price" type="number" class="border rounded px-2 py-1" required/>
        </li>
        <li>
          <label for="quantity" class="block mb-1">Quantidade</label>
          <input id="quantity" type="number" class="border rounded px-2 py-1" required/>
        </li>
        <li>
          <button
              type="button"
              class="mt-5 bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-4 rounded shadow w-max"
          >
            Salvar
          </button>
        </li>
      </ul>
    </div>
  </section>
</template>

<script lang="ts">
import axios from "axios";
import EditarProduto from "./EditarProduto.vue";
import {useFlashStore} from "../stores/flash";

interface Produto {
  id: number;
  product: string;
  price: number;
  quantity: number;
  selling: boolean;
}

export default {
  name: "Produtos",
  components: {EditarProduto},

  data() {
    return {
      produtos: [] as Produto[],
      show: false as boolean,
      editing: false as boolean,
      role: null as string,
    };
  },

  async mounted() {
    const response = await axios.get("http://localhost:8000/api/perfil", {withCredentials: true});
    this.role = response.data.role;

    const otherResponse = await axios.get("http://localhost:8000/api/produtos");
    this.produtos = otherResponse.data.message;
  },

  methods: {
    async getProducts() {
      const flash = useFlashStore();
      this.show = !this.show;
      if (!this.show) return;

      try {

      } catch (e) {
        if (e.response && e.response.data.error) {
          flash.set(e.response.data.error, "error");
        } else {
          flash.set("Erro ao buscar produtos.", "error");
        }
      }
    },

    async deleteProduct(id: number) {
      const flash = useFlashStore();
      try {
        await axios.delete(`http://localhost:8000/api/produtos/${id}`, {withCredentials: true});
        this.produtos = this.produtos.filter((produto) => produto.id !== id);
        flash.set("Produto deletado com sucesso!", "success");
      } catch (e) {
        console.error("Erro ao apagar o produto:", e);
        flash.set("Erro ao apagar o produto.", "error");
      }
    },
  },
};
</script>
