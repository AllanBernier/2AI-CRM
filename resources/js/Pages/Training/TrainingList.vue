<script setup>

import {onMounted, ref, watch} from "vue";
import SelectStatusModal from "@/Components/SelectStatusModal.vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import InputDropDown from "@/Components/InputDropDown.vue";
import {debounce} from "lodash";
import { useTrainingStore } from "@/Store/trainingStore.js";
import { useCustomerStore } from "@/Store/customerStore.js";
import { useSubcontractorStore } from "@/Store/subcontractorStore.js";
import Create from "@/Pages/Training/Create.vue";
import SelectCustomerActionModal from "@/Pages/Training/SelectCustomerActionModal.vue";
import SelectSubcontractorActionModal from "@/Pages/Training/SelectSubcontractorActionModal.vue";
import InputBDC from "@/Pages/Training/InputBDC.vue";


let trainingStore = useTrainingStore();
let customerStore = useCustomerStore();
let subcontractorStore = useSubcontractorStore();

let updateCol = (e, training, col) =>{
    trainingStore.updateCol(e.target.innerHTML, col, training)
}

// Change status
const statusModal = ref(false)
const subcontractorModal = ref(false)
const customerModal = ref(false)

const dateValue = ref([])
const selected_training_modal = ref({})
const updateStatus = (status) => {
    selected_training_modal.value.status = status
    axios.put(route('trainings.edit', selected_training_modal.value.id), selected_training_modal.value).then( (res) => {
        statusModal.value = false;
    })
}
const updateSubcontractorAction = (action) => {
    trainingStore.updateAction(action, 'action_subcontractor', selected_training_modal.value)
    subcontractorModal.value = false
}
const updateCustomerAction = (action) => {
    trainingStore.updateAction(action, 'action_customer', selected_training_modal.value)
    customerModal.value = false
}

// Change date
watch(dateValue, debounce(function (value) {
    trainingStore.updateDate(value[0], value[1], selected_training_modal.value)
}, 100));


</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
                    <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
                        <thead class="z-20 sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <create class="sticky z-40 left-0"/>

                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Société
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                N° Session
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Durée
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Localisation
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Intervenant
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Sous-Traitant
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Action Client
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Action Sous-Traitant
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Client
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                TJM Intervenant
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Frais journaliers
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                TJM 2AI
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Texte
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Num BDC
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                BDC
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Total HT
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Total Sous-Traitant
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Marge 2AI
                            </th>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                % Marge
                            </th>


                        </tr>
                        </thead>
                        <select-status-modal v-if="statusModal" @close="statusModal = false" @status="updateStatus"/>
                        <select-customer-action-modal v-if="customerModal" @close="customerModal = false" @action="updateCustomerAction"/>
                        <select-subcontractor-action-modal v-if="subcontractorModal" @close="subcontractorModal = false" @action="updateSubcontractorAction"/>

                        <tbody>
                            <tr class="border-b dark:bg-gray-900 dark:border-gray-700" v-for="training in trainingStore.trainings" :key="training.id" :class="trainingStore.bgColorClass(training)">
                                <th scope="row" class="md:left-10 left-0 shadow-inner z-10 sticky border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    :class="trainingStore.bgColorClass(training)">
                                    <span v-html="training.name" contenteditable @blur="updateCol($event, training, 'name')"></span>

                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{training.customer ? training.customer.company.name || 'N/A' : 'N/A'}}
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.num_session" contenteditable @blur="updateCol($event, training, 'num_session')"></span>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <vue-tailwind-datepicker
                                        v-slot="{ value, placeholder, clear }"
                                        v-model="dateValue"
                                        @click-prev="onClickSomething($event)"
                                        :formatter=" {
                                            date: 'YYYY-MM-DD',
                                            month: 'MMM'
                                          }"
                                        :shortcuts="false"
                                    >
                                        <button
                                            type="button"
                                            class="bg-gray-700 text-white rounded-full p-1 w-full"
                                            @click="selected_training_modal = training">
                                                    <span class="">
                                                        {{trainingStore.formatDate(training)}}
                                                    </span>
                                        </button>
                                    </vue-tailwind-datepicker>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.duree" contenteditable @blur="updateCol($event, training, 'duree')"></span> J
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p v-html="training.location" contenteditable @blur="updateCol($event, training, 'location')"></p>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input-drop-down
                                        placeholder="+ Ajouter formateur"
                                        :values="subcontractorStore.subcontractors"
                                        :can-add="false"
                                        :fill-on-select="true"
                                        :default-input="training.subcontractor ? training.subcontractor.first_name +' '+training.subcontractor.last_name : ''"
                                        @select="(id) => trainingStore.updateCol(id,'subcontractor_id', training)"
                                    />

                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{training.subcontractor ? training.subcontractor.leader ? training.subcontractor.leader.first_name + ' ' + training.subcontractor.leader.last_name : training.subcontractor.first_name + ' ' + training.subcontractor.last_name : ''}}
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    @click="statusModal = true; selected_training_modal = training">
                                    <button class="w-full h-full" id="show-modal" @click="statusModal = true; selected_training_modal = training">{{training.status}}</button>
                                </th>
                                <th scope="row"
                                        @click="customerModal = true; selected_training_modal = training"
                                        class="border-r px-2 font-medium text-gray-900 whitespace-nowrap text-white"
                                        :class="trainingStore.bgColorActionCustomer(training.action_customer)">
                                    <button class="w-full h-full" id="show-modal" @click="customerModal = true; selected_training_modal = training">{{training.action_customer}}</button>
                                </th>
                                <th scope="row"
                                    @click="subcontractorModal = true; selected_training_modal = training"
                                    class="border-r px-2 font-medium text-gray-900 whitespace-nowrap text-white w-full"
                                    :class="trainingStore.bgColorActionSubcontractor(training.action_subcontractor)">

                                    <button class="w-full h-full" id="show-modal" @click="subcontractorModal = true; selected_training_modal = training">{{training.action_subcontractor}}</button>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input-drop-down
                                        placeholder="+ Ajouter client"
                                        :values="customerStore.customers"
                                        :can-add="false"
                                        :fill-on-select="true"
                                        :default-input="training.customer ? training.customer.first_name +' '+training.customer.last_name : ''"
                                        @select="(id) => trainingStore.updateCol(id,'customer_id', training)"
                                    />
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.tjm_subcontractor" contenteditable @blur="updateCol($event, training, 'tjm_subcontractor')"></span> €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.travelling_expenses" contenteditable @blur="updateCol($event, training, 'travelling_expenses')"></span> €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.tjm_client" contenteditable @blur="updateCol($event, training, 'tjm_client')"></span> €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.text" contenteditable @blur="updateCol($event, training, 'text')"></span>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.num_bdc" contenteditable @blur="updateCol($event, training, 'num_bdc')"></span>
                                </th>
                                <th>
                                    <input-b-d-c :training="training" />
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ trainingStore.totalHT(training) }} €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ trainingStore.totalSubcontractor(training) }} €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ trainingStore.margeEur(training) }} €
                                </th>
                                <th scope="row"
                                    class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    :class="trainingStore.totalPercent(training) > 30 ? 'text-green-500' : 'text-red-500'">

                                    {{ trainingStore.totalPercent(training) }} %
                                </th>
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
