<script setup>
    let props = defineProps({
        company : Object,
    });

    let copyMe = (text) =>{
        navigator.clipboard.writeText(text);
    }


</script>

<template>
    <div class="p-6 pt-2 text-red-900 text-xl font-semibold">{{ company.name }}</div>

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
                    <th scope="row" class="border-r px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ customer.first_name }}
                    </th>
                    <td class="px-6 border-r">
                        {{ customer.last_name }}
                    </td>
                    <td class="border-r px-6">
                        {{ customer.role }}
                    </td>
                    <td class="border-r px-6">
                        {{ customer.phone }}
                        <button @click.prevent="copyMe(customer.phone)">Copy</button>

                    </td>
                    <td class="border-r px-6">
                        {{ customer.email }}
                        <button @click.prevent="copyMe(customer.email)">Copy</button>
                    </td>
                    <td class="border-r px-6">
                        {{ customer.city }}
                    </td>
                    <td class="border-r px-6">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
