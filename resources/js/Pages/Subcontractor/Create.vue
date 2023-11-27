<script setup>
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
const name = ref('')

let store = () =>{

    if (name.value === ''){
        return
    }

    let subcontractor_data = {
        first_name : name.value,
    }
    name.value = ''
    axios.post(route('subcontractors.store'), subcontractor_data )
        .then( (res) => {
            router.get(route('subcontractors.show', { subcontractor : res.data.data.id}));
        })
}

</script>

<template>
    <tr class="bg-white border-b">
        <th scope="row" class="border-r font-medium text-gray-900 whitespace-nowrap">
            <input v-model="name" class="outline-none appearance-none" type="text" placeholder="+ Ajouter Sous-traitant"  @keyup.enter="store" @focusout="store">
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
