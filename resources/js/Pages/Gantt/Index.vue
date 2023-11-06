<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref} from "vue";
import {GGanttChart, GGanttRow} from "@infectoone/vue-ganttastic";
import dayjs from "dayjs";


console.log(dayjs().format('YYYY-M-D'))

const row1BarList = ref([
    {
        myBeginDate: "2021-7-10",
        myEndDate: "2021-7-11",
        ganttBarConfig: {
            // each bar must have a nested ganttBarConfig object ...
            id: "unique-id-1", // ... and a unique "id" property
            label: "Lorem ipsum dolor"
        }
    }
])
const row2BarList = ref([
    {
        myBeginDate: "2021-6-20",
        myEndDate: "2021-12-4",
        ganttBarConfig: {
            id: "another-unique-id-2d",
            label: "Hey, look at me",
        }
    },
    {
        myBeginDate: "2021-7-1",
        myEndDate: "2021-7-7",
        ganttBarConfig: {
            id: "another-unique-id-2",
            label: "Hey, look at me",
        }
    }
])




let gantt_date = ref({
    start :dayjs(),
    end :dayjs().add(35, 'day')
})


let prev = () => {
    gantt_date.value.start = gantt_date.value.start.subtract(35, 'day')
    gantt_date.value.end = gantt_date.value.end.subtract(35, 'day')
    getSubcontractors()
}
let next = () => {
    gantt_date.value.start = gantt_date.value.start.add(35, 'day')
    gantt_date.value.end = gantt_date.value.end.add(35, 'day')
    getSubcontractors()
}

const subcontractors = ref({})

const getSubcontractors = async () => {
    subcontractors.value = await axios.get(route('invoices.subcontractors', {
        month: gantt_date.value.start.add(35, 'day').month(),
        year: gantt_date.value.start.year(),
    })).then((res) => {
        res.data.data.forEach( (sub) => {
            sub.trainings.forEach( (training) => {
                training['ganttBarConfig'] = {
                    id: training.id,
                    label: training.name,
                    immobile: true,
                    backgroundColor: "#404040"
                }
            })
        })
        return res.data.data
    })
}
onMounted(async () => {
    getSubcontractors();
})


</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Plannings</h2>

                <div class="text-white font-semibold">
                    <button class="p-2 m-2 bg-green-600" @click="prev">Précédent</button>
                    <button class="p-2 bg-green-600" @click="next">Suivant</button>
                </div>
            </div>
        </template>

        <div class="py-2">
            <div class="p-2 mx-auto">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <g-gantt-chart
                        class=""
                        :chart-start="gantt_date.start.format('YYYY-MM-DD')"
                        :chart-end="gantt_date.end.format('YYYY-MM-DD')"
                        precision="day"
                        bar-start="start_date"
                        bar-end="end_date"
                        color-scheme="dark"
                        date-format="YYYY-MM-DD"
                    >
                        <g-gantt-row v-for="subcontractor in subcontractors" :key="subcontractors.id" :label="subcontractor.first_name + ' ' + subcontractor.last_name" :bars="subcontractor.trainings"  />
                    </g-gantt-chart>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
