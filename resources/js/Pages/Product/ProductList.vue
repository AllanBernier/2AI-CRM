<script setup>
import CustomerStore from "@/Pages/Customer/CustomerStore.vue";
import SelectCompanyModal from "@/Components/SelectCompanyModal.vue";
import {ref} from "vue";
import ProductStore from "@/Pages/Product/ProductStore.vue";
import SelectTjmModal from "@/Components/SelectTjmModal.vue";

let props = defineProps({
    products : Object,
    companies : Object,
    tjm_types : Object,
});

let updateCol = (e, customer, col) =>{
    customer[col] = e.target.innerHTML
    axios.put(route('products.edit', customer.id), customer)

}


let companyModal = ref(false)
let tjmModal = ref(false)
let selected_product_modal = ref({})
let updateCompany = (company) => {
    selected_product_modal.value.company_id = company.id;
    axios.put(route('products.edit', {product : selected_product_modal.value.id}), selected_product_modal.value).then( (res) => {
        selected_product_modal.value.company = company;
        companyModal.value = false
    })
}

let updateTjmType = (tjm_type) => {
    selected_product_modal.value.tjm_type_id = tjm_type.id;
    axios.put(route('products.edit', {product : selected_product_modal.value.id}), selected_product_modal.value).then( (res) => {
        selected_product_modal.value.tjm_type = tjm_type;
        tjmModal.value = false
    })
}

let destroy = (product) => {
    axios.delete(route('products.destroy', product.id)).then( (res) => {
        let product_index = props.products.indexOf(product);
        props.products.splice(product_index, 1)
    })
}

</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
                    <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
                        <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 w-max-16">
                                URL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durée
                            </th>
                            <th scope="col" class="px-6 py-3">
                                TJM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                niveau
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Société
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <select-company-modal :companies="companies" v-if="companyModal" @close="companyModal = false" @company="updateCompany"/>
                        <select-tjm-modal :tjm_types="tjm_types" v-if="tjmModal" @close="tjmModal = false" @tjm="updateTjmType"/>

                        <tbody>
                        <product-store class="sticky top-10" :products="products"/>

                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="product in products" :key="product.id">
                            <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p v-html="product.code" contenteditable @blur="updateCol($event, product, 'code')"></p>
                            </th>
                            <td class="px-2 border-r">
                                <p v-html="product.description" contenteditable @blur="updateCol($event, product, 'description')"></p>
                            </td>
                            <td class="border-r">
                                <p v-html="product.url" contenteditable @blur="updateCol($event, product, 'url')"></p>
                            </td>
                            <td class="border-r px-2">
                                <span v-html="product.duree" contenteditable @blur="updateCol($event, product, 'duree')"></span> J
                            </td>
                            <td class="border-r px-2">
                                <span v-html="product.tjm" contenteditable @blur="updateCol($event, product, 'tjm')"></span> €
                            </td>
                            <td class="border-r px-2">
                                <button id="show-modal" @click="tjmModal = true; selected_product_modal = product">{{product.tjm_type == null ? '+ (Niveau)' : product.tjm_type.name}}</button>
                            </td>
                            <td class="border-r px-2">
                                <button id="show-modal" @click="companyModal = true; selected_product_modal = product">{{product.company == null ? '+ (Société)' : product.company.name}}</button>
                            </td>
                            <td class="border-r flex gap-1">
                                <button @click="destroy(product)" class="bg-red-600 p-1 rounded-md dark:text-red-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="2vh" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </button>
                                    <a :href="product.url" class="bg-blue-600 p-1 rounded-md dark:blue-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="2vh" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>
                                    </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
