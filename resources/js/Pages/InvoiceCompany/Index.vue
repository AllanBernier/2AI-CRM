<script setup>
import SubcontractorInvoiceLine from "@/Pages/Invoice/SubcontractorInvoiceLine.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref} from "vue";
import CompanyInvoice from "@/Pages/InvoiceCompany/CompanyInvoice.vue";

let companies = ref({});

onMounted(() => {
    axios.get(route('companies.index')).then((res) => {
        companies.value = res.data.data
    })
})

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Facturation Client</h2>
            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
                        Factures Client
                    </div>
                    <company-invoice v-for="company in companies" :key="companies.id" :company="company" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
