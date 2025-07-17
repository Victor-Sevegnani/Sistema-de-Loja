<template>
  <Header left-text="Editar Perfil"/>

  <main class="">
    <div class="flex flex-col justify-center items-center">
      <FlashMessages/>
    </div>
    <FormEditarPerfil/>
  </main>
</template>

<script lang="ts">
import FormEditarPerfil from "./FormEditarPerfil.vue";
import FlashMessages from "./FlashMessages.vue";
import Header from "../components/Header.vue";

export default {
  name: 'Perfil',
  components: {Header, FlashMessages, FormEditarPerfil}
}
</script>