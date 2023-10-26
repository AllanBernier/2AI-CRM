<script setup>

import {ref} from "vue";
import InputDropDown from "@/Components/InputDropDown.vue";

let props = defineProps({
    products : Object
});



let createProductAndTraining = (productName) => {
    console.log("Create product and create training : " + productName)
}

let createTraining = (idProduct) => {
    console.log("Create training with product id: " + idProduct)
}


</script>

<template>
        <th scope="row" class="text-left ">
            <input-drop-down
                placeholder="+ Ajouter formation"
                :values="[{name:'JVS-ANGU, m2i', id: 1 },{name:'JVS-REA, m2i', id: 2 },{name:'LI249, ib', id: 3 }]"
                :can-add="true"
                @create="createProductAndTraining"
                @select="createTraining"
            />
        </th>
</template>

<style scoped>

</style>
