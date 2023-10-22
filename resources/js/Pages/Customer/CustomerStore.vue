<script setup>

import {ref} from "vue";

const name = ref('')

let props = defineProps({
    customers : Object,
});

let store = () =>{

    if (name.value === ''){
        return
    }

    let customers_data = {
        first_name : name.value,
    }
    name.value = ''
    axios.post(route('customers.store'), customers_data )
        .then( (res) => { props.customers.unshift(res.data.data)})
}

</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
        <th scope="row" class="border-r font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <input v-model="name" class="outline-none appearance-none" type="text" placeholder="+ Ajouter client"  @keyup.enter="store" @focusout="store">
        </th>
        <td class="px-2 border-r">
        </td>
        <td class="border-r px-2">
        </td>
        <td class="border-r px-2">
        </td>
        <td class="border-r px-2">
        </td>
        <td class="border-r px-2">
        </td>
        <td class="border-r px-2">
        </td>
        <td class="border-r px-2">
        </td>
    </tr>
</template>

<style scoped>

</style>
