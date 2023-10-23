<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomerList from "@/Pages/Customer/CustomerList.vue";
import {ref, watch} from 'vue';
import { debounce } from "lodash";
import {router} from "@inertiajs/vue3";

let props = defineProps({
    customers : Object,
    filters : Object,
    companies : Object
});

let search = ref(props.filters.search);


watch(search, debounce(function (value) {
    router.get(route('customers.index'), {
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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>
                <input v-model="search" type="text" placeholder="Rechercher..." class="border px-2 rounded-lg mr-4"/>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <customer-list :companies="companies" :customers="customers"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
