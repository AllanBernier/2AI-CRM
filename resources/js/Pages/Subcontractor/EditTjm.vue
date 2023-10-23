<script setup>
let props = defineProps({
    subcontractor : Object
});

let updateTjm = (e, tjm) => {
    console.log(tjm)
    axios.put(route('tjms.edit',
        {
            subcontractor : tjm.pivot.subcontractor_id,
            tjm_type : tjm.pivot.tjm_type_id
        }
    ), {
        price : e.target.innerHTML
    })
}

</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
        <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 px-6 py-3" v-for="tjm in subcontractor.tjms">
                {{ tjm.name }}
            </th>
        </tr>
        </thead>

        <tbody>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <td class="border-r px-2" v-for="tjm in subcontractor.tjms" :key="tjm.id">
                <p v-html="tjm.pivot.price" contenteditable @blur="updateTjm($event, tjm)"></p>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
