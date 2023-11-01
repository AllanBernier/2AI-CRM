<script setup>

import {ref} from "vue";
import VueBasicAlert from "vue-basic-alert";
import {useTrainingStore} from "@/Store/trainingStore.js";

const trainingStore = useTrainingStore();

let props = defineProps({
    cursus : Object
})

let moduleName = ref('')

const createTraining = async () => {
    if (moduleName.value === '') {
        return null;
    }

    let training_data = {
        status: 'Cursus',
        product_id: props.cursus.product_id,
        customer_id: props.cursus.customer_id,
        tjm_client: props.cursus.tjm,
        travelling_expenses: props.cursus.travelling_expenses,
        location: props.cursus.location,
        text: moduleName.value,
        name: props.cursus.name,
        cursus_id : props.cursus.id
    }
    props.cursus.trainings.push(await trainingStore.createTraining(training_data));
    moduleName.value = ''

}

</script>

<template>
    <vue-basic-alert
        class="relative"
        :duration="200"
        :closeIn="1000"
        ref="alert"
    />

    <tr class="text-center border-2 border-gray-800 p-2">
        <td class="border-2 border-gray-800">
            <input v-model="moduleName" @blur="createTraining" @keydown.enter="createTraining">
        </td>
        <td  class="border-2 border-gray-800">
        </td>
        <td  class="border-2 border-gray-800">
        </td>
        <td  class="border-2 border-gray-800">
        </td>
        <td  class="border-2 border-gray-800">
        </td>
        <td  class="border-2 border-gray-800">
        </td>
    </tr>
</template>

<style scoped>

</style>
