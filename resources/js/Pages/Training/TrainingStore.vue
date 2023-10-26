<script setup>
import InputDropDown from "@/Components/InputDropDown.vue";
import {onMounted} from "vue";

let props = defineProps({
    products : Object
});

onMounted(()=> {
    props.products.forEach( (product) => {
        product.name = product.code + ", "+ product.company.name
    })
})


let createProductAndTraining = (productName) => {
    console.log("Create product and create training : " + productName)
}

let createTraining = (idProduct) => {

    let training_data = {
        product_id : idProduct
    }

    axios.post(route('trainings.store'), training_data )
        .then( (res) => {
            console.log('new product')
        })
}


</script>

<template>
        <th scope="row" class="text-left ">
            <input-drop-down
                placeholder="+ Ajouter formation"
                :values="products"
                :can-add="true"
                @create="createProductAndTraining"
                @select="createTraining"
            />
        </th>
</template>

<style scoped>

</style>
