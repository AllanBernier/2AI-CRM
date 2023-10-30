<script setup>
import VueBasicAlert from 'vue-basic-alert'

// use : <copy-to-clip-board-button class="pl-2" :text="customer.email"/>

let props = defineProps({
    text : String,
});

let copyMe = () =>{
    navigator.clipboard.writeText(props.text);
}

</script>

<template>

    <vue-basic-alert
        class="relative"
        :duration="200"
        :closeIn="1000"
        ref="alert" />

    <button @click.prevent="copyMe(); this.$refs.alert.showAlert('info',text, 'Texte Copié',{ iconSize: 25, iconType: 'solid',position: 'top right' })">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 40c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm144 418c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V118c0-3.3 2.7-6 6-6h42v36c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-36h42c3.3 0 6 2.7 6 6z"/></svg>
    </button>
</template>

<style scoped>

</style>
