<script setup>
import { useTrainingStore} from "@/Store/trainingStore.js";
import {useSubcontractorStore} from "@/Store/subcontractorStore.js";
import InputDropDown from "@/Components/InputDropDown.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import InlineShowCreateTraining from "@/Pages/Cursus/InlineShowCreateTraining.vue";

const trainingStore = useTrainingStore();
const subcontractorStore = useSubcontractorStore();
let props = defineProps({
    cursus : Object
})

const dateValue = ref([])
const selected_training_modal = ref({})
watch(dateValue, debounce(function (value) {
    trainingStore.updateDate(value[0], value[1], selected_training_modal.value)
}, 100));

const destroy = (training) => {
    trainingStore.destroy(training);
    const index = props.cursus.trainings.indexOf(training);
    props.cursus.trainings.splice(index, 1);
}

</script>

<template>
    <div class="flex">
        <div class="w-1/6"></div>
        <table class="w-5/6">
            <thead class="">
            <tr>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Module
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Durée
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Dates
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Formateurs
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    TJM Sous-traitant
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    TJM 2AI
                </th>
                <th class="border-2 border-gray-800 text-sm border-t-0">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="training in cursus.trainings" :key="training.id" class="text-center border-2 border-gray-800 p-2">
                <td class="border-2 border-gray-800">
                    <span v-html="training.text" contenteditable @blur="(e) => {trainingStore.updateCol(e.target.innerHTML, 'text', training)}"></span>
                </td>
                <td  class="border-2 border-gray-800">
                    <span v-html="training.duree" contenteditable @blur="(e) => {trainingStore.updateCol(e.target.innerHTML, 'duree', training)}"></span> J
                </td>
                <td  class="border-2 border-gray-800">
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
                </td>
                <td  class="border-2 border-gray-800">
                    <input-drop-down
                        placeholder="+ Ajouter"
                        :values="subcontractorStore.subcontractors"
                        :can-add="false"
                        :fill-on-select="true"
                        :default-input="training.subcontractor ? training.subcontractor.first_name + ' ' + training.subcontractor.last_name : ''"
                        @select="(id) => {trainingStore.updateCol(id, 'subcontractor_id',training )}"
                    />
                    {{}}
                </td>
                <td  class="border-2 border-gray-800">
                    <span v-html="training.tjm_subcontractor" contenteditable @blur="(e) => {trainingStore.updateCol(e.target.innerHTML, 'tjm_subcontractor', training)}"></span>€
                </td>
                <td  class="border-2 border-gray-800">
                    <span v-html="training.tjm_client" contenteditable @blur="(e) => {trainingStore.updateCol(e.target.innerHTML, 'tjm_client', training)}"></span>€
                </td>
                <td  class="border-2 border-gray-800">
                    <button @click="destroy(training)" class="font-medium bg-red-600 p-1 rounded-md dark:text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </button>
                </td>
            </tr>

            <inline-show-create-training :cursus="cursus" />
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
