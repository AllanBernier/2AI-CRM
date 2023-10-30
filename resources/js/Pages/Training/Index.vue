<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import {router} from "@inertiajs/vue3";
import CustomerList from "@/Pages/Customer/CustomerList.vue";
import ProductList from "@/Pages/Product/ProductList.vue";
import SubcontractorList from "@/Pages/Subcontractor/SubcontractorList.vue";
import TrainingList from "@/Pages/Training/TrainingList.vue";

let props = defineProps({
    trainings : Object,
    filters : Object,
    products : Object,
    subcontractors : Object
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
    router.get(route('trainings.index'), {
            search: value
        },
        {
            preserveState: true, replace: true
        });
}, 500));

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sous-traitants</h2>
                <input v-model="search" type="text" placeholder="Rechercher..." class="border px-2 rounded-lg mr-4"/>
            </div>
        </template>

        <div class="py-2">
            <div class="w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <training-list :trainings="trainings" :products="products"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
