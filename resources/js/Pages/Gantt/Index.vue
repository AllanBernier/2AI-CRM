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
        console.log(res)
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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Plannings</h2>

            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        Factures Sous Traitant



                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
