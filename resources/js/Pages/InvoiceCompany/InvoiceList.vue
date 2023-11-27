<script setup>
import {onMounted, ref} from "vue";
import Paginator from "@/Components/Paginator.vue";

const props = defineProps({invoices: Object})

const changePage = (url) => {
    axios.get(url)
        .then( (res) => invoices.value = res.data)
}

const showInvoice = (invoice) => {
    window.open(route('invoice.company.show.invoice', {invoice : invoice.id}), '_blank');
}

</script>

<template>
    <div class="ml-6">
        <div class="flex justify-between items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
        </div>

        <div class="px-4 text-red-600" v-if="invoices.total === 0">
            Pas encore de factures
        </div>

        <div v-else>
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Facture N°
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Statut
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Total
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Due Date
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Date création
                    </th>
                    <th class="border-2 border-gray-800 text-sm border-t-0">
                        Nombre formation
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="invoice in invoices.data" :key="invoice.id" class="text-center border-2 border-gray-800 p-2">
                    <td class="border-2 border-gray-800 text-webkit-center cursor-pointer"
                        @click="showInvoice(invoice)">
                        <svg class="text-center" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                    </td>
                    <td class="border-2 border-gray-800">
                        1024
                    </td>
                    <td class="border-2 border-gray-800">
                        Envoyé au client
                    </td>
                    <td class="border-2 border-gray-800">
                        9562€
                    </td>
                    <td class="border-2 border-gray-800">
                        16 déc 2023
                    </td>
                    <td class="border-2 border-gray-800">
                        12 déc 2023
                    </td>
                    <td class="border-2 border-gray-800">
                        12
                    </td>
                </tr>
                </tbody>
            </table>
            <paginator @navigate-to="changePage" :paginated-data="invoices" />
        </div>
    </div>
</template>

<style scoped>

.text-webkit-center{
    text-align: -webkit-center;
}
</style>
