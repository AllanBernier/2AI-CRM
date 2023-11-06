<script setup>
import {onMounted, ref} from "vue";

let selected = ref(new Date().getFullYear())
let open = ref(false)
let closeDropDown = () => {
    setTimeout(() => {
        open.value = false
    }, 150)
}

</script>

<template>
    <div class="relative text-left inline-flex flex-col border border-gray-600">
        <button @click="open = true;" @blur="closeDropDown" class="w-24 p-3 flex justify-center outline-none">
            {{ selected }}
        </button>

    <div v-if="open" class="absolute w-full z-10 left-0 mt-12 right-0 w-full mt-12 bg-white border-t border-gray-300">
        <button @click="$emit('update:year', 2022); selected = 2022" class="text-center block w-full text-left border border-gray-600 hover:bg-gray-100">
            2022
        </button>
        <button @click="$emit('update:year', 2023); selected = 2023" class="text-center block w-full text-left border border-gray-600 hover:bg-gray-100">
            2023
        </button>
        <button @click="$emit('update:year', 2024); selected = 2024" class="text-center block w-full text-left border border-gray-600 hover:bg-gray-100">
            2024
        </button>
        <button @click="$emit('update:year', 2025); selected = 2025" class="text-center block w-full text-left border border-gray-600 hover:bg-gray-100">
            2025
        </button>
    </div>
    </div>
</template>

<style scoped>

</style>
