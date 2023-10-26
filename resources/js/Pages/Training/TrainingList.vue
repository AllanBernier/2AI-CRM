<script setup>

import TrainingStore from "@/Pages/Training/TrainingStore.vue";
import {ref} from "vue";
import SelectStatusModal from "@/Components/SelectStatusModal.vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import dayjs from "dayjs";
import InputDropDown from "@/Components/InputDropDown.vue";


let props = defineProps({
    trainings : Object,
    products : Object
});

// Change status
let statusModal = ref(false)
let selected_training_modal = ref({})
let updateStatus = (status) => {
    statusModal.value = false;
}

// Change date
const dateValue = ref([])

const onClickSomething = (newDate) => {
    console.log(newDate); // newDate instanceof dayjs
};
let formatDate = (training) => {
    return  dayjs(training.start_date).format('MMM') === dayjs(training.end_date).format('MMM') ?
        dayjs(training.start_date).format('D') + ' - ' + dayjs(training.end_date).format('D MMM') :
        dayjs(training.start_date).format('D MMM') + ' - ' + dayjs(training.end_date).format('D MMM')

}



let totalHT = (training) => {
    return ((training.tjm_client + training.travelling_expenses) * training.duree).toFixed(2)
}
let totalSubcontractor = (training) => {
    return ((training.tjm_subcontractor + training.travelling_expenses) * training.duree).toFixed(2)
}
let margeEur = (training) => {
    return (totalHT(training) - totalSubcontractor(training)).toFixed(2)
}
let totalPercent = (training) => {
    return (margeEur(training) / totalHT(training) * 100).toFixed(2)
}

let bgColorClass = (training) => {
    switch(training.status) {
        case "nouveau":
            return "bg-purple-200"
        case "option":
            return "bg-amber-100"
        case "confirmé":
            return "bg-lime-100"
        case "archivé":
            return "bg-red-100"
        default:
            return "bg-red"
    }
}
</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
                    <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
                        <thead class="z-10 sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <training-store class="" :products="products"/>

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
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Num BDC
                            </th>


                        </tr>
                        </thead>
                        <select-status-modal v-if="statusModal" @close="statusModal = false" @status="updateStatus"/>

                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="training in trainings" :key="training.id" :class="bgColorClass(training)">
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{training.product.code}}
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{training.customer.company.name}}
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
                                            date: 'YYYY-MM-DD HH:mm:ss',
                                            month: 'MMM'
                                          }"
                                        :shortcuts="false"
                                    >
                                        <button
                                            type="button"
                                            class="bg-gray-700 text-white rounded-full p-1"
                                        >
                                                    <span class="">
                                                        {{formatDate(training)}}
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
                                        placeholder="+ Ajouter formation"
                                        :values="[{name:'JVS-ANGU, m2i', id: 1 },{name:'JVS-REA, m2i', id: 2 },{name:'LI249, ib', id: 3 }]"
                                        @create="createProductAndTraining"
                                        @select="createTraining"
                                        :default-input="training.subcontractor.first_name +' '+training.subcontractor.last_name"
                                    />

                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{training.subcontractor.first_name}} {{training.subcontractor.last_name}}
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button id="show-modal" @click="statusModal = true; selected_training_modal = training">{{training.status == null ? '+ (Status)' : training.status}}</button>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button id="show-modal" @click="statusModal = true; selected_training_modal = training">{{training.status == null ? '+ (Status)' : training.status}}</button>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button id="show-modal" @click="statusModal = true; selected_training_modal = training">{{training.status == null ? '+ (Status)' : training.status}}</button>
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input-drop-down
                                        placeholder="+ Ajouter formation"
                                        :values="[{name:'JVS-ANGU, m2i', id: 1 },{name:'JVS-REA, m2i', id: 2 },{name:'LI249, ib', id: 3 }]"
                                        @create="createProductAndTraining"
                                        @select="createTraining"
                                        :default-input="training.customer.first_name +' '+training.customer.last_name"
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

                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ totalHT(training) }} €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{totalSubcontractor(training)}} €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{margeEur(training)}} €
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ totalPercent(training) }} %
                                </th>
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-html="training.num_bdc" contenteditable @blur="updateCol($event, training, 'num_bdc')"></span>
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
