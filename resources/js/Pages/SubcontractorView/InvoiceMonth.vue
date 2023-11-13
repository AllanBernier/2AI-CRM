<script setup>
import {onMounted, ref} from "vue";
import {useTrainingStore} from "@/Store/trainingStore.js";

let trainingStore = useTrainingStore()
const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

let props = defineProps({
    month: Number
})

const trainings = ref({})

onMounted( async () => {
    trainings.value = await axios.post(route('subcontractors.trainings.month'), {month: props.month})
        .then((res) => {
            return res.data.data
        })
})

let file = ref(undefined);
let uploaded = ref(false);
const addInvoice = () => {
    let formData = new FormData();
    formData.append('file_content', file.value);
    formData.append('trainings', trainings.value.map( (a)=> (a.id)));
    uploaded.value = true
    axios.post(route('invoices.store'), formData)
}



</script>

<template>
    <div class="mt-2 flex items-center font-semibold w-full bg-gray-800 p-2 text-white uppercase">
        {{monthNames[month -1]}}
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
            :class="training.invoice_file ? 'bg-green-50':''"
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
            <td  class="">
                    Facture
            </td>
            <td v-if="!uploaded">
                <input
                    class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    id="formFileLg"
                    type="file"
                    accept="application/pdf"
                    @change="(event) => file = event.target.files[0]"
                />

                <div v-if="file">
                    <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white" @click="addInvoice" >
                        Envoyer
                    </button>
                </div>
            </td>
            <td v-if="uploaded">
                <p class=" w-full bg-green-600 text-white">
                    Reçu
                </p>
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
