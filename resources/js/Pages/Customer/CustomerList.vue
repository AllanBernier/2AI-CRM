<script setup>
import CopyToClipBoardButton from "@/Components/CopyToClipBoardButton.vue";

let props = defineProps({
    company : Object,
});

let updatefirstName = (e, customer, col) =>{
    customer[col] = e.target.innerHTML
    axios.put(route('customers.edit', customer.id), customer).then( (res) => {
        console.log(res)
    })

}


</script>

<template>
    <div class="p-6 pt-2 text-red-900 text-xl font-semibold underline">{{ company.name }}</div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fonction
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telephone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Localisation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>


            <tbody>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="customer in company.customers" :key="customer.id">
                    <th scope="row" class="border-r px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <p v-html="customer.first_name" contenteditable @blur="updatefirstName($event, customer, 'first_name')"></p>
                    </th>
                    <td class="px-2 border-r">
                        <p v-html="customer.last_name" contenteditable @blur="updatefirstName($event, customer, 'last_name')"></p>
                    </td>
                    <td class="border-r px-2">
                        <p v-html="customer.role" contenteditable @blur="updatefirstName($event, customer, 'role')"></p>
                    </td>
                    <td class="border-r px-2">
                        <copy-to-clip-board-button :text="customer.phone"/>
                        <p v-html="customer.phone" contenteditable @blur="updatefirstName($event, customer, 'phone')"></p>

                    </td>
                    <td class="border-r px-2">
                        <copy-to-clip-board-button class="pl-2" :text="customer.email"/>
                        <p v-html="customer.email" contenteditable @blur="updatefirstName($event, customer, 'email')"></p>
                    </td>
                    <td class="border-r px-2">
                        <p v-html="customer.city" contenteditable @blur="updatefirstName($event, customer, 'city')"></p>
                    </td>
                    <td class="border-r px-2">
                        <a href="#" class="font-medium bg-red-600 dark:text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</template>

<style scoped>

</style>
