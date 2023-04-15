<template>
<div class="d-flex flex-row">
    <div class="col-6 m-1 p-0">
        <textarea name="body" v-model="text" cols="50" rows="50" class="form-control" placeholder="本文"></textarea>
    </div>
    <div class="col-6 m-1 p-0" v-html="markdown"></div>
</div>
</template>

<script lang="ts">
import { ref, watch } from 'vue'
import { marked } from 'marked'

export default {
    name: 'PreviewMarkdown',
    setup() {
        let markdown = ref('');
        let text = ref('');

        const conv = ()=> {
            markdown.value = marked(text.value);
        }

        conv();

        watch(text, () => {
            conv()
        })

        return {
            markdown,
            text,
        }
    },
    
}
</script>