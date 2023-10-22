<script setup>
import CopyToClipBoardButton from "@/Components/CopyToClipBoardButton.vue";
import CustomerStore from "@/Pages/Customer/CustomerStore.vue";

let props = defineProps({
    customers : Object,
});

let updateCol = (e, customer, col) =>{
    customer[col] = e.target.innerHTML
    axios.put(route('customers.edit', customer.id), customer).then( (res) => {
        console.log(res)
    })

}

let destroy = (customer) => {
    axios.delete(route('customers.destroy', customer.id)).then( (res) => {
        var customer_index = props.customers.indexOf(customer);
        props.customers.splice(customer_index, 1)
    })
}

</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
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
                                    Société
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
                            <customer-store class="sticky top-8" :customers="customers"/>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="customer in customers" :key="customer.id">
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p v-html="customer.first_name" contenteditable @blur="updateCol($event, customer, 'first_name')"></p>
                                </th>
                                <td class="px-2 border-r">
                                    <p v-html="customer.last_name" contenteditable @blur="updateCol($event, customer, 'last_name')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <div v-if="customer.company">
                                        <p v-html="customer.company.name" contenteditable @blur="updateCol($event, customer, 'role')"></p>
                                    </div>
                                </td>
                                <td class="border-r px-2">
                                    <p v-html="customer.role" contenteditable @blur="updateCol($event, customer, 'role')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <p v-html="customer.phone" contenteditable @blur="updateCol($event, customer, 'phone')"></p>

                                </td>
                                <td class="border-r px-2">
                                    <p v-html="customer.email" contenteditable @blur="updateCol($event, customer, 'email')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <p v-html="customer.city" contenteditable @blur="updateCol($event, customer, 'city')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <button @click="destroy(customer)" class="font-medium bg-red-600 p-1 rounded-md dark:text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
