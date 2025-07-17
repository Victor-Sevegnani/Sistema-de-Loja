<template>
  <div>
    <button
        @click="toggleEdit"
        class="bg-blue-500 p-0.5 text-white font-semibold rounded-md mt-2">
      Editar Produto
    </button>

    <div v-if="isEditing" class="mt-4 space-y-2">
      <input v-model="editedProduct.product" type="text" class="border rounded px-2 py-1 w-full" required>

      <input v-model.number="editedProduct.price" type="number" class="border rounded px-2 py-1 w-full" required>

      <input v-model.number="editedProduct.quantity" type="number" class="border rounded px-2 py-1 w-full" required>

      <button
          @click="saveEdit"
          class="bg-green-500 p-1 text-white font-semibold rounded-md mt-2">
        Salvar Edição
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import axios from "axios";
import {useFlashStore} from '../stores/flash';

export default {
  name: 'EditarProduto',
  props: {
    produto: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      isEditing: false,
      editedProduct: {
        product: '',
        price: 0,
        quantity: 0
      }
    }
  },
  methods: {
    toggleEdit() {
      this.isEditing = !this.isEditing;
      if (this.isEditing) {
        this.editedProduct = {
          product: this.produto.product,
          price: this.produto.price,
          quantity: this.produto.quantity
        }
      }
    },

    async saveEdit() {
      const flash = useFlashStore();
      try {
        const response = await axios.put(`http://localhost:8000/api/produtos/${this.produto.id}`, {
          product: this.editedProduct.product,
          price: this.editedProduct.price,
          quantity: this.editedProduct.quantity,
        }, {withCredentials: true});

        flash.set(response.data.message, 'success')

        this.$emit('atualizar-produto', {
          ...this.produto,
          product: this.editedProduct.product,
          price: this.editedProduct.price,
          quantity: this.editedProduct.quantity
        });

        this.isEditing = false;
      } catch (e) {
         (e.response.data.message) ? flash.set(e.response.data.message) : console.log(e);
      }
    }
  }
}
</script>
