<script setup>
let props = defineProps({
    subcontractor : Object,
})

let updateCol = (e, customer, col) =>{
    customer[col] = e.target.innerHTML
    axios.put(route('subcontractors.edit', customer.id), customer)
}



</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
        <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 px-6 py-3">
                Nom
            </th>
            <th scope="col" class="px-6 py-3">
                Prenom
            </th>
            <th scope="col" class="px-6 py-3">
                Email Perso
            </th>
            <th scope="col" class="px-6 py-3">
                Email Companie
            </th>
            <th scope="col" class="px-6 py-3">
                Phone
            </th>
            <th scope="col" class="px-6 py-3">
                company_name
            </th>
            <th scope="col" class="px-6 py-3">
                city
            </th>
        </tr>
        </thead>

        <tbody>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <p v-html="subcontractor.first_name" contenteditable @blur="updateCol($event, subcontractor, 'first_name')"></p>
            </th>
            <td class="px-2 border-r">
                <p v-html="subcontractor.last_name" contenteditable @blur="updateCol($event, subcontractor, 'last_name')"></p>
            </td>
            <td class="border-r px-2">
                <p v-html="subcontractor.email_perso" contenteditable @blur="updateCol($event, subcontractor, 'email_perso')"></p>
            </td>
            <td class="border-r px-2">
                <p v-html="subcontractor.email_company" contenteditable @blur="updateCol($event, subcontractor, 'email_company')"></p>
            </td>
            <td class="border-r px-2">
                <p v-html="subcontractor.phone" contenteditable @blur="updateCol($event, subcontractor, 'phone')"></p>
            </td>
            <td class="border-r px-2">
                <p v-html="subcontractor.company_name" contenteditable @blur="updateCol($event, subcontractor, 'company_name')"></p>
            </td>
            <td class="border-r px-2">
                <p v-html="subcontractor.city" contenteditable @blur="updateCol($event, subcontractor, 'city')"></p>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
