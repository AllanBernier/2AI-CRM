<script setup>
import InputDropDown from "@/Components/InputDropDown.vue";
import {onMounted} from "vue";
import { useTrainingStore } from "@/Store/trainingStore.js";

let trainingStore = useTrainingStore();


const props = defineProps({
    products : Object
});

onMounted(()=> {
    props.products.forEach( (product) => {
        product.name = product.code + ", "+ product.company.name
    })
})

</script>

<template>
        <th scope="row" class="text-left ">
            <input-drop-down
                placeholder="+ Ajouter formation"
                :values="products"
                :can-add="false"
                @select="trainingStore.createTrainingByIdProduct"
            />
        </th>
</template>

<style scoped>

</style>
