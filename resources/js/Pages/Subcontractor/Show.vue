<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditForm from "@/Pages/Subcontractor/EditForm.vue";
import EditTjm from "@/Pages/Subcontractor/EditTjm.vue";
import Products from "@/Pages/Subcontractor/Products.vue";

let props = defineProps({
    subcontractor : Object
});

let computeFullName = () => {
    if (props.subcontractor.last_name !== null)
        return props.subcontractor.first_name + " " + props.subcontractor.last_name
    return props.subcontractor.first_name
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{computeFullName()}}</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg ">
                    <edit-form :subcontractor="subcontractor"/>
                    <div class="grid grid-cols-3 mr-5 gap-6 pt-6">
                        <products class="overflow-hidden h-64" :subcontractor="subcontractor" />
                        <edit-tjm class="max-h-6" :subcontractor="subcontractor"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
