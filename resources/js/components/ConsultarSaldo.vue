<template>
  <section class="flex flex-col p-6 max-w-3xl mx-auto items-center">
    <button
        @click="showMenu"
        class="bg-amber-400 hover:bg-amber-500 transition text-white font-semibold py-2 px-4 rounded shadow mb-6 w-max">
      Consultar Saldo
    </button>
    <span v-if="ShowUserBalance" class="text-xl font-semibold font-">R$ {{ UserBalance }}</span>
  </section>
</template>


<script lang="ts">
import axios from "axios";

export default {
  name: 'ConsultarSaldo',
  data() {
    return {
      UserBalance: null,
      ShowUserBalance: false
    }
  },

  async mounted() {
    await axios.get('http://localhost:8000/api/perfil', {withCredentials: true,
    }).then((response) => {
      this.UserBalance = response.data.money.toFixed(2)
    }).catch((e) => {
      console.log(`Falha ao consultar saldo ${e}`)
    })
  },

  methods: {
    showMenu() {
      this.ShowUserBalance = !this.ShowUserBalance;
    }
  }
}

</script>