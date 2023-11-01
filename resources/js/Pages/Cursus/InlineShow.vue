<script setup>
import InlineShowHeader from "@/Pages/Cursus/InlineShowHeader.vue";
import InlineShowBody from "@/Pages/Cursus/InlineShowBody.vue";
import {ref} from "vue";

let props = defineProps({
    cursus : Object
})

let modal = ref(false)

</script>

<template>
    <div class="p-2">
        <inline-show-header @modal="modal = !modal" :cursus="cursus"/>
        <inline-show-body v-if="modal" :cursus="cursus"/>
    </div>
</template>

<style scoped>

</style>
