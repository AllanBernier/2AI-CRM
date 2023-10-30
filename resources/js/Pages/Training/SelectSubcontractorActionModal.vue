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
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('')"
                                @click="$emit('action', '')">
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Solliciter')"
                                @click="$emit('action', 'Solliciter')">
                            Solliciter
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Solliciter dates')"
                                @click="$emit('action', 'Solliciter dates')">
                            Solliciter dates
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Envoyé bon d\'option')"
                                @click="$emit('action', 'Envoyé bon d\'option')">
                            Envoyé bon d'option
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Envoyé BDC')"
                                @click="$emit('action', 'Envoyé BDC')">
                            Envoyé BDC
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Bon pour accord')"
                                @click="$emit('action', 'Bon pour accord')">
                            Bon pour accord
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Annuler une option')"
                                @click="$emit('action', 'Annuler une option')">
                            Annuler une option
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionSubcontractor('Annuler une confirmation')"
                                @click="$emit('action', 'Annuler une confirmation')">
                            Annuler une confirmation
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="$emit('close')">
                            Fermer
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
