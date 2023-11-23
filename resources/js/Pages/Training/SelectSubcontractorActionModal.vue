<script setup>
import { useTrainingStore } from "@/Store/trainingStore.js";
let trainingStore = useTrainingStore();

</script>

<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">


                    <div class="modal-body grid gap-4 lg:grid-cols-2">
                        <button class="bg-gray-800 uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('')"
                                @click="$emit('action', '')">
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('solliciter')"
                                @click="$emit('action', 'solliciter')">
                            solliciter
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('solliciter dates')"
                                @click="$emit('action', 'solliciter dates')">
                            solliciter dates
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('envoyé bon d\'option')"
                                @click="$emit('action', 'envoyé bon d\'option')">
                            envoyé bon d'option
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('envoyé bdc')"
                                @click="$emit('action', 'envoyé bdc')">
                            envoyé bdc
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('bon pour accord')"
                                @click="$emit('action', 'bon pour accord')">
                            bon pour accord
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('annuler une option')"
                                @click="$emit('action', 'annuler une option')">
                            Annuler une option
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('annuler une confirmation')"
                                @click="$emit('action', 'annuler une confirmation')">
                            annuler une confirmation
                        </button>
                        <button class="uppercase bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="$emit('close')">
                            fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>

</template>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 300px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

</style>
