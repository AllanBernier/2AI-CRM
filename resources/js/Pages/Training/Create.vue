<script setup>
import InputDropDown from "@/Components/InputDropDown.vue";
import {onMounted} from "vue";
import { useTrainingStore } from "@/Store/trainingStore.js";
import { useProductStore } from "@/Store/productStore.js";

let trainingStore = useTrainingStore();
let productStore = useProductStore();



onMounted(()=> {
    productStore.getProductsIfNotLoaded();
})

</script>

<template>
        <th scope="row" class="text-left ">
            <input-drop-down
                placeholder="+ Ajouter formation"
                :values="productStore.products"
                :can-add="false"
                @select="trainingStore.createTrainingByIdProduct"
            />
        </th>
</template>
