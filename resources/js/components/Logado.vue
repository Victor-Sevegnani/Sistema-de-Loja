<template>
  <Header :leftText="headerText"/>

  <main class="flex items-center justify-center mt-10">
    <section class="flex flex-col items-center">
      <FlashMessages/>
      <section class="flex">
        <div class="flex flex-col items-center">
          <Produtos/>
        </div>
        <div v-if="role === 'Admin'" class="flex flex-col items-center">
          <RegistroDeProdutos/>
        </div>
        <div class="flex flex-col items-center">
          <ConsultarSaldo/>
        </div>
        <div v-if="role === 'User'" class="flex flex-col items-center">
          <ComprarProduto/>
        </div>
        <div v-else-if="role === 'Admin'" class="flex flex-col items-center">
          <AdicionarSaldo/>
        </div>
        <div>
          <VerCompras/>
        </div>
      </section>
    </section>

  </main>
</template>

<script lang="ts">
import axios from "../lib/axios";
import Produtos from "./Produtos.vue";
import {useFlashStore} from "../stores/flash";
import RegistroDeProdutos from "./RegistroDeProdutos.vue";
import ConsultarSaldo from "./ConsultarSaldo.vue";
import ComprarProduto from "./ComprarProduto.vue";
import FlashMessages from "./FlashMessages.vue";
import AdicionarSaldo from "./AdicionarSaldo.vue";
import VerCompras from "./VerCompras.vue";
import Header from "../components/Header.vue";


export default {
  name: 'Logado',
  components: {
    Header,
    VerCompras, AdicionarSaldo, FlashMessages, ComprarProduto, ConsultarSaldo, RegistroDeProdutos, Produtos
  },
  data() {
    return {
      flash: useFlashStore(),
      username: null as string,
      role: null as boolean,
    }
  },

  computed: {
    headerText(): string {
      return `Seja bem vindo ${this.username}`
    }
  },

  async mounted() {
    await axios.get('/sanctum/csrf-cookie', {withXSRFToken: true});
    await axios.get('/api/perfil')
        .then((response) => {
          this.username = response.data.name;
          this.role = response.data.role;
        })
        .catch((e) => {
          console.log('Falha ao consultar perfil ' + e)
        })
  }
}
</script>

