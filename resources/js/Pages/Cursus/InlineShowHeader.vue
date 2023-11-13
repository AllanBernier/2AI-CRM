<script setup>

import { useTrainingStore} from "@/Store/trainingStore.js";
import { useCursusStore} from "@/Store/cursusStore.js";
import {useProductStore} from "@/Store/productStore.js";
import {useCustomerStore} from "@/Store/customerStore.js";
import {ref, watch} from "vue";
import InputDropDown from "@/Components/InputDropDown.vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import {debounce} from "lodash";

const trainingStore = useTrainingStore();
const cursusStore = useCursusStore();
const productStore = useProductStore();
const customerStore = useCustomerStore();

const props = defineProps({
    cursus : Object
})
let updateCol = (e, cursus, col) => {
    cursusStore.updateCol(e.target.innerHTML, cursus, col)
}

const selected_col = ref('')
const date_value = ref({})
watch(date_value, debounce(function (value) {
    props.cursus['selected_col'] = value.undefined
    cursusStore.updateCol(value.undefined, props.cursus, selected_col.value)
}, 100));

let modal = ref(false)

</script>

<template>
    <div class="flex items-center font-semibold w-full bg-gray-800 text-white p-2">

        <button class="mr-2" @click="$emit('modal'); modal = !modal">
            <svg v-if="modal" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
        </button>

        <span v-html="cursus.name" contenteditable @blur="updateCol($event, cursus, 'name')"></span>

        <span class="ml-6 bg-violet-600 p-2 rounded-full">Nouveau</span>
    </div>
    <table class="min-w-full">
        <thead>
        <tr>
            <th class="border-2 border-gray-800 text-sm">
                TJM
            </th>
            <th class="border-2 border-gray-800 text-sm">
                Localisation
            </th>
            <th class="border-2 border-gray-800 text-sm">
                FDD
            </th>
            <th class="border-2 border-gray-800 text-sm">
                Produit
            </th>
            <th class="border-2 border-gray-800 text-sm">
                Contact
            </th>
            <th class="border-2 border-gray-800 text-sm">
                Envoyé au client
            </th>
            <th class="border-2 border-gray-800 text-sm">
                Envoyé au formateurs
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center">
            <td class="border-2 border-gray-800 p-2 text-xl">
                <span v-html="cursus.tjm" contenteditable @blur="updateCol($event, cursus, 'tjm')"></span>€
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl">
                <span v-html="cursus.location" contenteditable @blur="updateCol($event, cursus, 'location')"></span>
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl">
                <span v-html="cursus.travelling_expenses" contenteditable @blur="updateCol($event, cursus, 'travelling_expenses')"></span>€
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl">
                <input-drop-down
                    placeholder="+ Ajouter Produit"
                    :values="productStore.products"
                    :can-add="false"
                    :fill-on-select="true"
                    :default-input="cursus.product ? cursus.product.code : ''"
                    @select="async (id) => { cursus.tjm = await cursusStore.updateProduct(id, cursus, 'product_id')}"
                />
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl">
                <input-drop-down
                    placeholder="+ Ajouter Client"
                    :values="customerStore.customers"
                    :can-add="false"
                    :fill-on-select="true"
                    :default-input="cursus.customer ? cursus.customer.first_name + ' ' + cursus.customer.last_name : ''"
                    @select="(id) => {cursusStore.updateCol(id, cursus, 'customer_id')}"
                />
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl ">
                    <vue-tailwind-datepicker
                        class="z-10"
                        v-slot="{ value, placeholder, clear }"
                        v-model="date_value"
                        as-single
                        @click-prev="onClickSomething($event)"
                        :formatter=" {
                            date: 'YYYY-MM-DD',
                            month: 'MMM'
                        }"
                        :shortcuts="false">
                        <button
                            type="button"
                            class="bg-gray-700 text-white rounded-full p-1 w-full"
                            @click="selected_col = 'send_to_customer'">
                            <span class="">
                                {{trainingStore.formatSingleDate(cursus.send_to_customer)}}
                            </span>
                        </button>
                    </vue-tailwind-datepicker>
            </td>
            <td class="border-2 border-gray-800 p-2 text-xl z-10">
                <vue-tailwind-datepicker
                    class="z-10"
                    v-slot="{ value, placeholder, clear }"
                    v-model="date_value"
                    as-single
                    @click-prev="onClickSomething($event)"
                    :formatter=" {
                        date: 'YYYY-MM-DD',
                        month: 'MMM'
                    }"
                    >
                    <button
                        type="button"
                        class="bg-gray-700 text-white rounded-full p-1 w-full"
                        @click="selected_col = 'send_to_subcontractor'">
                            <span class="">
                                {{trainingStore.formatSingleDate(cursus.send_to_subcontractor)}}
                            </span>
                    </button>
                </vue-tailwind-datepicker>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>
    svg{fill:#ffffff}
</style>
