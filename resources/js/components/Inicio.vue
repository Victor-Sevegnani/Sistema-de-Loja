<template>
  <header class="flex flex-col items-center justify-center bg-gray-100 py-5">
    <h1 class="text-3xl font-semibold">Bem-vindo ao sistema</h1>
    <FlashMessages/>
  </header>

  <main class="px-4 bg-gradient-to-b bg-gray-50">
    <section class="flex flex-col md:flex-row justify-center items-start gap-14 max-w-7xl mx-auto">
      <FormLogin />
      <FormRegistro />
    </section>
  </main>
</template>


<script lang="ts">
import FormLogin from "./FormLogin.vue";
import {useFlashStore} from '../stores/flash';
import FlashMessages from "./FlashMessages.vue";
import FormRegistro from "./FormRegistro.vue";

export default {
  name: 'Inicio',
  components: {FormRegistro, FlashMessages, FormLogin},

  data() {
    return {
      flash: useFlashStore()
    }
  }
}
</script>

