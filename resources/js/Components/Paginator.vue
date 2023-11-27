<script setup>

defineProps(["paginatedData"])
defineEmits(["navigate-to"]);

</script>

<template>
    <div class="flex items-center justify-between w-full">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <p class="text-sm text-gray-700 paginator">
                Affichage de
                <span class="">{{ paginatedData.from }}</span>
                à
                <span class="">{{ paginatedData.to }}</span>
                sur
                <span class="">{{ paginatedData.total }}</span>
            </p>
            <div v-if="paginatedData.last_page > 1">
                <span v-for="link in paginatedData.links" :key="link.label">
                    <button @click="$emit('navigate-to', link.url)" v-if="link.url"
                            class="relative inline-flex items-center px-2 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                            :class="{'font-extrabold bg-gray-200':link.active}"
                    >
                        <span v-html="link.label"/>
                    </button>
                </span>
            </div>
        </div>
    </div>

</template>
