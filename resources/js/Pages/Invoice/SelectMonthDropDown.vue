<script setup>
import {onMounted, ref} from "vue";

let select = ref({})
let open = ref(false)

let months = ref({})

onMounted(() => {
    months.value = [
        { text : 'Janvier', value : 1 },
        { text : 'Février', value : 2 },
        { text : 'Mars', value : 3 },
        { text : 'Avril', value : 4 },
        { text : 'Mai', value : 5 },
        { text : 'Juin', value : 6 },
        { text : 'Juillet', value : 7 },
        { text : 'Aout', value : 8 },
        { text : 'Septembre', value : 9 },
        { text : 'Octobre', value : 10 },
        { text : 'Novembre', value : 11 },
        { text : 'Decembre', value : 12 },
    ]
    select.value = months.value[new Date().getMonth()];
})

let closeDropDown = () => {
    setTimeout(() => {
        open.value = false
    }, 150)
}

</script>

<template>
    <div class="relative text-left inline-flex flex-col border border-gray-600">
        <button @click="open = true;" @blur="closeDropDown" class="w-24 p-3 flex self-center outline-none">
            {{ select.text }}
        </button>

        <div v-if="open" class="absolute w-full z-10 left-0 mt-12 right-0 w-full mt-12 bg-white border-t border-gray-300">
            <button v-for="month in months" @click="$emit('update:month', month.value); select = month" class="text-center block w-full text-left border border-gray-600 hover:bg-gray-100">
                {{ month.text }}
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
