<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InlineShow from "@/Pages/Cursus/InlineShow.vue";
import InlineShowCreate from "@/Pages/Cursus/InlineShowCreate.vue";
import {useCursusStore} from "@/Store/cursusStore.js";

const cursusStore = useCursusStore();

const props = defineProps({
    cursuses : Array
})

const createCursus = async (name) => {
    props.cursuses.unshift(await cursusStore.createCursus(name));
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cursus</h2>
            </div>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm sm:rounded-lg">

                    <inline-show-create @create="createCursus"/>

                    <inline-show v-for="cursus in cursuses" :key="cursus.id" :cursus="cursus"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
