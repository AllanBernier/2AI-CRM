<script setup>
import InputDropDown from "@/Components/InputDropDown.vue";
import {useProductStore} from "@/Store/productStore.js";
import {onMounted} from "vue";

let productStore = useProductStore()

let props = defineProps({
    subcontractor : Object
});

onMounted(()=> {
    productStore.getProductsIfNotLoaded();
})
const attachProduct = (id) => {

    if ( props.subcontractor.products.findIndex( (p) => p.id === id) === -1 ){
        let index = productStore.products.findIndex((p) => p.id === id)
        props.subcontractor.products.unshift(productStore.products[index]);
        axios.post(route('subcontractor.product.attach', {product: id, subcontractor: props.subcontractor.id}))
    }
}

const detachProduct = (product) => {
    let index = props.subcontractor.products.findIndex( (p) => p.id === product.id)
    props.subcontractor.products.splice(index, 1);
    axios.post(route('subcontractor.product.detach', {subcontractor: props.subcontractor.id, product: product.id}))
}

</script>

<template>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="row" class="text-left ">
                <input-drop-down
                    placeholder="+ Ajouter formation"
                    :values="productStore.products"
                    :can-add="false"
                    @select="attachProduct"
                />
            </th>
            <th scope="col" class="px-6 py-3 px-6 py-3">
                supprimer
            </th>
        </tr>
        </thead>

        <tbody>
        <tr class="bg-white border-b"
            v-for="product in subcontractor.products"
            :key="product.id">
            <td class="border-r px-2" >
                {{product.code}}
            </td>
            <td class="border-r px-2" >
                <button @click="detachProduct(product)" class="font-medium bg-red-600 p-1 rounded-md dark:text-red-500 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                </button>
            </td>

        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
