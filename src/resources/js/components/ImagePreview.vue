<template>
      <div class="text-center">
        <div class="preview-box" v-if="url">
            <img class="image-preview" :src="url">
        </div>
        <div class="preview-box" v-else>
            <img class="image-preview rounded shadow" :src="'/images/default1234.png'">
        </div>
      <label class="input-group-btn mb-0">
        <span class="btn purple-gradient py-1 grow">
          画像選択<input type="file" name="image" ref="preview" v-on:change="show" style="display:none">
        </span>
      </label>
      </div>
</template>

<script>
export default {
    name: "ImagePreview",

    data() {
        return {
            url:""
        }
    },
    methods: {
        show() {
            const file = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
        }
    }
}
</script>

<style>
.Image-preview {
  width: 300px;
  height: 220px;
  background-position: center center;
  background-size: cover;
  display: inline-block;
  margin: 3px auto;
}
</style>