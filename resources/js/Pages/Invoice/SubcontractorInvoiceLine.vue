<script setup>
import {useTrainingStore} from "@/Store/trainingStore.js";

const props = defineProps({
    subcontractor : Object
})

let trainingStore = useTrainingStore()

</script>

<template>
    <div class="p-2 ml-12 ">

        <div class="flex justify-between items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
            <div class="flex">
                {{subcontractor.first_name}} {{subcontractor.last_name}}

                <button v-if="subcontractor.invoice">
                    Télécharger facture
                </button>
                <button v-else class="ml-2 rounded-full bg-green-600 pl-2 pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                </button>
            </div>

            <div class="mr-8">
                {{ trainingStore.totalTrainingsSubcontractor(subcontractor.trainings) }} €
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
            <tr>
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
            <tr v-for="training in subcontractor.trainings" :key="training.id" class="text-center border-2 border-gray-800 p-2">
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

    </div>
</template>

<style scoped>
    svg{fill:#ffffff}
</style>
