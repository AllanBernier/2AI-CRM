<script setup>
import SubcontractorLayout from "@/Layouts/SubcontractorLayout.vue";
import NewTrainings from "@/Pages/SubcontractorView/NewTrainings.vue";
import {onMounted, ref} from "vue";
import ConfirmBDC from "@/Pages/SubcontractorView/ConfirmBDC.vue";
import IncomingTrainings from "@/Pages/SubcontractorView/IncomingTrainings.vue";


let newTrainings = ref({})
let toConfirm = ref({})
let incoming = ref({})

onMounted( async () => {
    newTrainings.value = await axios.get(route('subcontractors.trainings.new')).then((res) => {return res.data.data})
    toConfirm.value = await axios.get(route('subcontractors.trainings.toconfirm')).then((res) => {return res.data.data})
    incoming.value = await axios.get(route('subcontractors.trainings.incoming')).then((res) => {return res.data.data})
})

</script>

<template>
    <SubcontractorLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <new-trainings :trainings="newTrainings"/>

                    <confirm-b-d-c :trainings="toConfirm"/>

                    <incoming-trainings :trainings="incoming" />
                </div>
            </div>
        </div>
    </SubcontractorLayout>
</template>

<style scoped>

</style>
