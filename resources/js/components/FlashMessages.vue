<template>
  <div
      v-if="flash.message && flash.type === 'success'"
      class="flex items-center rounded-md text-xl h-auto w-max mt-5 bg-green-500 p-2 text-white font-semibold"
  >
    {{ flash.message }}

  </div>

  <div
      v-else-if="flash.message && flash.type === 'error'"
      class="flex items-center rounded-md text-xl h-auto w-max mt-5 bg-red-500 p-2 text-white font-semibold"
  >
    {{ flash.message }}
  </div>
</template>

<script lang="ts">
import {useFlashStore} from '../stores/flash';
export default {
  name: 'FlashMessages',
  data() {
    return {
      flash: useFlashStore()
    }
  }
}
</script>