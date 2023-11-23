<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SelectMonthDropDown from "@/Pages/Invoice/SelectMonthDropDown.vue";
import SelectYearDropDown from "@/Pages/Invoice/SelectYearDropDown.vue";
import {onMounted, ref, watch} from "vue";
import {debounce} from "lodash";
import {router} from "@inertiajs/vue3";
import SubcontractorInvoiceLine from "@/Pages/Invoice/SubcontractorInvoiceLine.vue";


const subcontractors = ref({})

let date = ref({
    month : new Date().getMonth() + 1,
    year : new Date().getFullYear()
})


const getSubcontractors = async () => {
    subcontractors.value = await axios.get(route('invoices.subcontractors', {
        month: date.value.month,
        year: date.value.year,
    })).then((res) => {
        return res.data.data
    })
}
onMounted(async () => {
     getSubcontractors();
})


</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Facturation Sous-traitant</h2>

                <div class="flex gap-2">
                    <select-year-drop-down :year="date.year" @update:year="(year) =>{date.year = year; getSubcontractors()}"/>
                    <select-month-drop-down  :month="date.month" @update:month="(month) =>{date.month = month; getSubcontractors()}"/>
                </div>
            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
                        Factures Sous Traitant

                        <div class="ml-2 rounded-full bg-green-600 p-1 pr-2 pl-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        </div>
                    </div>

                    <subcontractor-invoice-line v-for="subcontractor in subcontractors" :key="subcontractors.id" :subcontractor="subcontractor" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
svg{fill:#ffffff}
</style>
