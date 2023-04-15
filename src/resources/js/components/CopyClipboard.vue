<template>
  <div class="justify-content-center">
    <input id="terget" :value="url" size="25">
  </div>
</template>

<script lang="ts">
  export default {
    name: "CopyClipboard",
    props: {
      currentUrl: String
    },

  computed: {
      url(){
        return this.currentUrl;
      }
    }
  }
</script>
