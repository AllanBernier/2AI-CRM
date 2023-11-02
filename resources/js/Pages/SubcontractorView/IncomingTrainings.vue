<script setup>
import {useTrainingStore} from "@/Store/trainingStore.js";

let trainingStore = useTrainingStore()

const props = defineProps({
    trainings : Object
})

</script>

<template>
    <div class="p-2">
        <div class="flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
            Formations à venir
        </div>

        <table class="table-auto w-full">
            <thead>
            <tr>
                <th class="w-64 border-2 border-gray-800 text-sm border-t-0">
                    Statut
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
                <td class="border-2 border-gray-800 w-64">
                    <div class=" w-full bg-blue-600 text-white"
                        :class="training.status === 'option' ? 'bg-orange-600' : training.status === 'annulé' ? 'bg-red-600' : 'bg-green-600'  ">
                        {{ training.status }}
                    </div>
                </td>
                <td class="border-2 border-gray-800">
                    toto
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
                    toto
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

</style>
