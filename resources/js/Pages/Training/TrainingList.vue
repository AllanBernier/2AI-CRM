<script setup>
import CustomerStore from "@/Pages/Customer/CustomerStore.vue";
import SelectCompanyModal from "@/Components/SelectCompanyModal.vue";
import {ref} from "vue";
import ProductStore from "@/Pages/Product/ProductStore.vue";
import SelectTjmModal from "@/Components/SelectTjmModal.vue";
import TrainingStore from "@/Pages/Training/TrainingStore.vue";

let props = defineProps({
    trainings : Object,
});

let updateCol = (e, training, col) =>{
    training[col] = e.target.innerHTML
    axios.put(route('trainings.edit', training.id), training).then( (res) => {
        console.log(res)
    })

}

</script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
                <div class="table-wrp block max-h-[65vh]	">
                    <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400 max-h-">
                        <thead class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 px-6 py-3">
                                Code
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                            <training-store/>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="product in products" :key="product.id">
                                <th scope="row" class="border-r px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p v-html="product.code" contenteditable @blur="updateCol($event, product, 'code')"></p>
                                </th>
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
