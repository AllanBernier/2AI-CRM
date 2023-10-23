<script setup>

import {ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

let props = defineProps({
});
const showingNavigationDropdown = ref(false);
</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

        <th scope="row" class="border-r font-medium text-gray-900 whitespace-nowrap dark:text-white">

        </th>
    </tr>
</template>

<style scoped>

</style>
