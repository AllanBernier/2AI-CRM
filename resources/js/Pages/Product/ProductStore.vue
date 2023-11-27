<script setup>

import {ref} from "vue";

const name = ref('')

let props = defineProps({
    products : Object,
});

let store = () =>{

    if (name.value === ''){
        return
    }

    let product_data = {
        code : name.value,
    }
    name.value = ''
    axios.post(route('products.store'), product_data )
        .then( (res) => { props.products.unshift(res.data.data)})
}

</script>

<template>
    <tr class="bg-white border-b">
        <th scope="row" class="border-r font-medium text-gray-900 whitespace-nowrap">
            <input v-model="name" class="outline-none appearance-none" type="text" placeholder="+ Ajouter Produit"  @keyup.enter="store" @focusout="store">
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
    </tr>
</template>

<style scoped>

</style>
