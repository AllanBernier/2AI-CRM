<script setup>
const props = defineProps({training : Object})

const save = (event) => {
    let formData = new FormData();
    let file = event.target.files[0]
    formData.append('file_content', file);
    axios.post(route('trainings.bdc.upload', {training: props.training.id}), formData)
        .then((res) => {
            props.training.bdc_file = res.data.data
        })
}

</script>

<template>
    <label :for="'dropzone-file-' + training.id " class="w-full h-full flex flex-col items-center justify-center cursor-pointer"
           :class="training.bdc_file ? 'bg-green-500' : 'bg-gray-50'">
        <div class="flex flex-col items-center justify-center">
            <svg class="w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
            </svg>
        </div>
        <input :id="'dropzone-file-' + training.id"
               type="file"
               accept="application/pdf"
               class="hidden"
               @change="save"
        />
    </label>
</template>

<style scoped>

</style>
