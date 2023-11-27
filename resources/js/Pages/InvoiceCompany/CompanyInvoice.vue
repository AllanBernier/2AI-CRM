<script setup>

import {onMounted, ref} from "vue";
import {useTrainingStore} from "@/Store/trainingStore.js";
import SelectStatusModal from "@/Pages/InvoiceCompany/SelectStatusModal.vue";
import VueBasicAlert from "vue-basic-alert";
import InvoiceList from "@/Pages/InvoiceCompany/InvoiceList.vue";

const trainingStore = useTrainingStore()
const props = defineProps({company : Object})
const trainings = ref({})
const statusModal = ref(false)
const selected_training_modal = ref({})
const invoices = ref([]);

const updateStatus = (value) => {
    statusModal.value = false;
    selected_training_modal.value.company_invoice_status = value
    trainingStore.updateCol(value, 'company_invoice_status', selected_training_modal.value)
}
const showPDF = (training) => {
    window.open(route('invoice.company.show.bdc', {training : training.id}), '_blank');
}

const generateInvoice = () => {
    const data = {
        trainings : trainings.value.filter( t => t.checked === true).map( t => t.id)
    }
    axios.post(route('invoice.company.store'), data)
    .then( (res) => {
        invoices.value.data.unshift(res.data.data)
        window.open(route('invoice.company.show.invoice', {invoice : res.data.data.id}), '_blank');
        trainings.value = trainings.value.filter( t => t.checked !== true);
    })
}



onMounted(() => {
    axios.get(route('invoices.company.billing', {company : props.company.id}))
        .then( (res) => trainings.value = res.data.data)

    axios.get(route('invoice.company.paginated', {company : props.company.id}))
        .then( (res) => invoices.value = res.data)

})





</script>

<template>
    <div class="p-2 ml-12 ">

        <select-status-modal v-if="statusModal" @close="statusModal = false" @action="updateStatus"/>
        <vue-basic-alert
            class="relative"
            :duration="200"
            :closeIn="1000"
            ref="alert"
        />



        <div class="flex justify-between items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
            <div class="flex">
                {{company.name}}
            </div>

            <button class="bg-green-600 p-1 rounded-md"
                @click="trainings.filter( t => t.checked === true).length === 0 ? this.$refs.alert.showAlert('info','', 'Séléctionne au moins une formation',{ iconSize: 25, iconType: 'solid',position: 'top right' }) : generateInvoice()"
            >
                Générer facture
            </button>
        </div>


        <table class="table-auto w-full">
            <thead>
            <tr>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Statut
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    BDC
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Nom
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Durée
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Date
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Localisation
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Formateur
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    TJM
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Frais de déplacement
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Total
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="training in trainings" :key="training.id" class="text-center border-2 border-gray-800 p-2">
                <td class="border-2 border-gray-800">
                    <input
                        type="checkbox"
                        v-model="training.checked"
                        :id="training.id"
                    >
                </td>
                <td class="border-2 border-gray-800 text-white cursor-pointer"
                    :class="trainingStore.bgColorInvoiceStatus(training.company_invoice_status)"
                    @click="statusModal = true; selected_training_modal = training"
                >
                    {{ training.company_invoice_status }}
                </td>
                <td v-if="training.bdc_file"
                    class="border-2 border-gray-800 text-webkit-center cursor-pointer"
                    @click="showPDF(training)">

                    <!--Eye icon -->
                    <svg class="text-center" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                </td>
                <td v-else class="border-2 border-gray-800 text-webkit-center">
                    <!--Slash Eye icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
                </td>

                <td class="border-2 border-gray-800">
                    {{ training.name }}
                </td>
                <td  class="border-2 border-gray-800">
                    {{ training.duree }} J
                </td>
                <td  class="border-2 border-gray-800">
                    {{ trainingStore.formatDate(training) }}
                </td>
                <td  class="border-2 border-gray-800">
                    {{ training.location }}
                </td>
                <td  class="border-2 border-gray-800">
                    {{ training.subcontractor.first_name + ' ' + training.subcontractor.last_name}}
                </td>
                <td  class="border-2 border-gray-800">
                    {{ training.tjm_subcontractor }} €
                </td>
                <td  class="border-2 border-gray-800">
                    {{ training.travelling_expenses }} €
                </td>
                <td  class="border-2 border-gray-800">
                    {{ trainingStore.totalSubcontractor(training) }} €
                </td>
            </tr>

            </tbody>
        </table>
        <invoice-list :invoices="invoices"/>
    </div>
</template>

<style scoped>

.text-webkit-center{
    text-align: -webkit-center;
}
</style>
