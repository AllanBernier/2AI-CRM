<script setup>
import {onMounted, ref} from "vue";

let props = defineProps({
    placeholder : {
        type :String,
        default : 'Rechercher ...'
    },
    canAdd : {
        type: Boolean,
        default: false
    },
    fillOnSelect : {
        type: Boolean,
        default: false
    },
    values: {
        type: Object,
    },
    defaultInput: {
        type: String
    }

})
let input = ref('')
let open = ref(false)

let select = () => {

}

let filtedValue = () => {
    if (input.value === '')
        return props.values
    return props.values.filter( (value) => value['name'].includes(input.value) )
}

let openDropDown = () => {
    open.value = !open.value
}

let closeDropDown = () => {
    setTimeout(() => {
        open.value = false
    }, 150)
}

const emit = defineEmits([
    "select",
    "create"
])

onMounted(() => {
    if (props.defaultInput !== null){
        input.value = props.defaultInput;
    }
})


</script>

<template>
    <div class="border-b dark:bg-gray-900 dark:border-gray-700">
        <div class="relative text-left inline-flex flex-col border-r">
            <input v-model="input" type="text" @focusin="openDropDown" @blur="closeDropDown" :placeholder="placeholder"
                   class="p-3 flex items-center outline-none">

            <div v-if="open" class="absolute w-full z-10 left-0 mt-12 right-0 w-full mt-12 bg-white border-t border-gray-300">
                <button v-for="value in filtedValue()" @click.prevent="$emit('select',value.id); input = fillOnSelect ? value.name : ''" class="block p-3 w-full text-left border-b border-gray-300 hover:bg-gray-100">{{value.name}}</button>

                <button v-if="canAdd" @click.prevent="$emit('create', input); input = fillOnSelect ? input :''" class="block p-3 w-full text-left border-b border-gray-300 hover:bg-gray-100">
                    Créer : {{input}}
                </button>

            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
