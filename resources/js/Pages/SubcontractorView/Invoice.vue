<script setup>
import SubcontractorLayout from "@/Layouts/SubcontractorLayout.vue";
import InvoiceMonth from "@/Pages/SubcontractorView/InvoiceMonth.vue";
import {ref} from "vue";

const month = ref((new Date()).getMonth());

</script>

<template>
    <SubcontractorLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <invoice-month :month="month "/>
                    <invoice-month :month="month - 1"/>
                    <invoice-month :month="month - 2"/>
                    <invoice-month :month="month - 3"/>
                    <invoice-month :month="month - 4"/>
                    <invoice-month :month="month - 5"/>
                </div>
            </div>
        </div>
    </SubcontractorLayout>
</template>

<style scoped>

</style>
