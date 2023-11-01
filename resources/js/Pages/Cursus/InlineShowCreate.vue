<script setup>

import {ref} from "vue";

const search = ref('')

</script>

<template>
    <div class="p-2">
        <div class="flex items-center font-semibold w-full bg-gray-800 p-2">
            <input v-model="search" @keydown.enter="$emit('create', search); search = ''" type="text" placeholder="Ajouter un cursus..." class="border px-2 rounded-lg mr-4"/>
        </div>
    </div>
</template>

<style scoped>

</style>
