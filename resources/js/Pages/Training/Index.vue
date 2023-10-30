<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TrainingList from "@/Pages/Training/TrainingList.vue";


</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Formations</h2>
                <input type="text" placeholder="Rechercher..." class="border px-2 rounded-lg mr-4"/>
            </div>
        </template>

        <div class="py-2">
            <div class="w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <training-list/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
