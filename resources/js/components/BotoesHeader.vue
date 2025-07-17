<template>
  <button class="text-lg hover:underline" type="submit">{{ buttonText }}</button>
</template>

<script lang="ts">
export default {
  name: 'BotoesHeader',
  props: {
    buttonText: {
      type: String,
      required: true,
    },
  },

}
</script>