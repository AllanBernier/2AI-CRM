<script setup>
import {useTrainingStore} from "@/Store/trainingStore.js";
import VueBasicAlert from "vue-basic-alert";

let trainingStore = useTrainingStore()

const props = defineProps({
    trainings : Object
})

const arbdc = async (training) => {
    await trainingStore.arbdc(training)
    props.trainings.splice(props.trainings.findIndex(t => t.id === training.id) , 1)
}

</script>

<template>
    <div class="p-2">
        <div class="flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
            Accusé réception bon de commande
        </div>

        <vue-basic-alert
            class="relative"
            :duration="200"
            :closeIn="1000"
            ref="alert" />

        <table class="table-auto w-full">
            <thead>
            <tr>
                <th class="w-64 border-2 border-gray-800 text-sm border-t-0">
                    AR BDC
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
                    <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white" @click="arbdc(training); this.$refs.alert.showAlert('info','', 'Formation confirmé',{ iconSize: 25, iconType: 'solid',position: 'top right' })">
                        Accepter
                    </button>
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
                    {{ training.subcontractor.first_name + ' ' + training.subcontractor.last_name  }}
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
