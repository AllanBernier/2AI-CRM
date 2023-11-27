<script setup>
import {onMounted, ref} from "vue";
import {useTrainingStore} from "@/Store/trainingStore.js";
import VueBasicAlert from "vue-basic-alert";

let trainingStore = useTrainingStore()
const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

let props = defineProps({
    month: Number
})

const trainings = ref({})

const canAdd = ref(true)


onMounted( async () => {
    trainings.value = await axios.post(route('subcontractors.trainings.month'), {month: props.month})
        .then((res) => {
            canAdd.value = res.data.data.filter( t => t.invoice_file.length > 0 ).length > 0
            console.log(res.data.data.filter( t => t.invoice_file.length > 0 ).length > 0)
            return res.data.data
        })
})

let invoiceNumber = ref('');
const addInvoice = () => {
    const data = {
        invoice_number : invoiceNumber.value,
        trainings : trainings.value.map( (a)=> (a.id))
    }
    canAdd.value = false
    axios.post(route('invoices.store'), data)
        .then( (res) => {
            trainings.value.forEach( t => t.invoice_file = "not empty")
            window.open(route('invoices.subcontractors.show', {training : trainings.value[0].id}), '_blank');
        }
    )
}
const show = () => {
    window.open(route('invoices.subcontractors.show', {training : trainings.value[0].id}), '_blank');
}


</script>

<template>
    <vue-basic-alert
        class="relative"
        :duration="200"
        :closeIn="1000"
        ref="alert" />

    <div class="mt-2 flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase gap-6">
        <div>
            {{monthNames[month -1]}}
        </div>

        <div v-if="canAdd">
            <input class="text-black" type="text" placeholder="N° Facture" v-model="invoiceNumber">
            <button class="ml-2 p-2 bg-green-600 hover:bg-green-700 rounded-md"
            @click="invoiceNumber === '' ?
            this.$refs.alert.showAlert('info','', 'Entrez un numéro de facture !',{ iconSize: 25, iconType: 'solid',position: 'top right' }) :
            addInvoice()">
                Générer Facture
            </button>
        </div>

    </div>

    <div class="border-2 border-gray-800 border-t-0 p-2" v-if="trainings.length == 0">
        Vous n'avez pas fait de formation ce mois ci
    </div>
    <table v-else class="table-auto w-full">
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
        <tr v-for="training in trainings"
            :key="training.id"
            class="text-center border-2 border-gray-800 p-2"
        >
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

        <tr class="text-center border-2 border-gray-800 p-2">
            <td v-if="!canAdd" class="p-1 m-1 bg-green-600 hover:bg-green-700 text-white font-semibold cursor-pointer"
                @click="show">
                Voir Facture
            </td>

            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="">
            </td>
            <td  class="border-2 border-gray-800">
                {{ trainingStore.totalTrainingsSubcontractor(trainings) }} €
            </td>
        </tr>

        </tbody>
    </table>

</template>

<style scoped>

</style>
