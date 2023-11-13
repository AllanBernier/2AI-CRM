<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref, watch} from "vue";
import {GGanttChart, GGanttRow} from "@infectoone/vue-ganttastic";
import dayjs from "dayjs";
import {useTrainingStore} from "@/Store/trainingStore.js";
import {useProductStore} from "@/Store/productStore.js";
import InputDropDown from "@/Components/InputDropDown.vue";
import {debounce} from "lodash";
import {router} from "@inertiajs/vue3";

const trainingStore = useTrainingStore();
const productStore = useProductStore()
const subcontractors = ref({})
let product = ref('')

let gantt_date = ref({
    start :dayjs(),
    end :dayjs().add(35, 'day')
})

let prev = () => {
    gantt_date.value.start = gantt_date.value.start.subtract(35, 'day')
    gantt_date.value.end = gantt_date.value.end.subtract(35, 'day')
    if (product.value === '') {
        getSubcontractors()
    } else {
        search(product.value)
    }
}
let next = () => {
    gantt_date.value.start = gantt_date.value.start.add(35, 'day')
    gantt_date.value.end = gantt_date.value.end.add(35, 'day')

    if (product.value === '') {
        getSubcontractors()
    } else {
        search(product.value)
    }
}


const getSubcontractors = async () => {
    subcontractors.value = await axios.post(route('gantt.show'), {
        start_date: gantt_date.value.start.add(1,'day').format('YYYY-MM-DD'),
        end_date: gantt_date.value.end.subtract(1,'day').format('YYYY-MM-DD'),
    }).then((res) => {
        res.data.data.forEach( (sub) => {
            sub.trainings.forEach( (training) => {
                training['ganttBarConfig'] = {
                    id: training.id,
                    label: training.name,
                    immobile: true,
                    style: {
                        background: trainingStore.bgColorStyle(training),
                        borderRadius: "20px",
                        border: "1px",
                        borderColor: 'black',
                        color: "black"
                    }
                }
            })
        })
        return res.data.data
    })
}

let search = async (product_id) => {

    subcontractors.value = await axios.post(route('gantt.search', {
        product: product_id
    }), {
        start_date: gantt_date.value.start.add(1, 'day').format('YYYY-MM-DD'),
        end_date: gantt_date.value.end.subtract(1, 'day').format('YYYY-MM-DD'),
    }).then((res) => {
        res.data.data.forEach((sub) => {
            sub.trainings.forEach((training) => {
                training['ganttBarConfig'] = {
                    id: training.id,
                    label: training.name,
                    immobile: true,
                    style: {
                        background: trainingStore.bgColorStyle(training),
                        borderRadius: "20px",
                        border: "1px",
                        borderColor: 'black',
                        color: "black"
                    }
                }
            })
        })
        return res.data.data
    })
}

watch(product, debounce(async function (product_id) {
    search(product_id)
}, 500));

onMounted(async () => {
    getSubcontractors();
    productStore.getProductsIfNotLoaded();

})


</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="flex gap-6">
                    <h2 class="self-center font-semibold text-xl text-gray-800 leading-tight">Plannings</h2>
                    <input-drop-down
                        placeholder="Produit.."
                        :values="productStore.products"
                        :can-add="false"
                        :fillOnSelect="true"
                        @select="(value) => product = value"
                        @close:empty="getSubcontractors"
                    />
                </div>

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
