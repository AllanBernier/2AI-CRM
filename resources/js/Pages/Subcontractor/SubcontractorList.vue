<script setup>
import {Link} from "@inertiajs/vue3";
import InputDropDown from "@/Components/InputDropDown.vue";
import { useSubcontractorStore } from "@/Store/subcontractorStore.js";
import {onMounted} from "vue";
import Create from "@/Pages/Subcontractor/Create.vue";
let subcontractorStore = useSubcontractorStore();

let props = defineProps({
    subcontractors : Object,
});


onMounted( ()=> {
    subcontractorStore.getSubcontractorsIfNotLoaded();
})
let destroy = (subcontractor) => {
    axios.delete(route('subcontractors.destroy', subcontractor.id)).then( (res) => {
        var subcontractor_index = props.subcontractors.indexOf(subcontractor);
        props.subcontractors.splice(subcontractor_index, 1)
    })
}

let updateCol = (e, subcontractor, col) =>{
    subcontractor[col] = e.target.innerHTML
    axios.put(route('subcontractors.edit', subcontractor.id), subcontractor)
}



</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
                        <thead class="z-10 sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prenom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sous-Traitant
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Telephone
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
                            <create class="sticky top-10 z-40"/>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="subcontractor in subcontractors" :key="subcontractor.id">
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p v-html="subcontractor.first_name" contenteditable @blur="updateCol($event, subcontractor, 'first_name')"></p>
                                </th>
                                <td class="px-2 border-r">
                                    <p v-html="subcontractor.last_name" contenteditable @blur="updateCol($event, subcontractor, 'last_name')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <p v-html="subcontractor.email_perso" contenteditable @blur="updateCol($event, subcontractor, 'email_perso')"></p>
                                </td>
                                <td class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input-drop-down
                                        placeholder="+ Ajouter formateur"
                                        :values="subcontractorStore.subcontractors"
                                        :can-add="false"
                                        :fill-on-select="true"
                                        :default-input="subcontractor.leader ? subcontractor.leader.first_name +' '+ subcontractor.leader.last_name : subcontractor.first_name + ' ' + subcontractor.last_name"
                                        @select="(id) => subcontractorStore.updateCol(id,'subcontractor_id', subcontractor)"
                                    />

                                </td>
                                <td class="border-r px-2">
                                    <p v-html="subcontractor.phone" contenteditable @blur="updateCol($event, subcontractor, 'phone')"></p>
                                </td>
                                <td class="border-r px-2">
                                    <p v-html="subcontractor.city" contenteditable @blur="updateCol($event, subcontractor, 'city')"></p>
                                </td>
                                <td class="border-r flex gap-1">
                                    <button @click="destroy(subcontractor)" class="font-medium bg-red-600 p-1 rounded-md dark:text-red-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </button>
                                    <Link :href="route('subcontractors.show', {subcontractor : subcontractor.id})" class="font-medium bg-blue-600 p-1 rounded-md dark:text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8v56H224c-35.3 0-64 28.7-64 64v48c0 13.3 10.7 24 24 24s24-10.7 24-24V280c0-8.8 7.2-16 16-16h64v56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"/></svg>
                                    </Link>
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
