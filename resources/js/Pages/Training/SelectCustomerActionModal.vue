<script setup>
import { useTrainingStore } from "@/Store/trainingStore.js";
let trainingStore = useTrainingStore();

</script>

<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container uppercase">
                    <div class="modal-body grid gap-4 lg:grid-cols-2">
                        <button class="bg-gray-800 uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('')"
                                @click="$emit('action', '')">

                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('ar nouveau')"
                                @click="$emit('action', 'ar nouveau')">
                            AR Nouveau
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('envoyé intervenant')"
                                @click="$emit('action', 'envoyé intervenant')">
                            Envoyé Intervenant
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('relance option')"
                                @click="$emit('action', 'relance option')">
                            Relance Option
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('ar bdc')"
                                @click="$emit('action', 'ar bdc')">
                            AR BDC
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('ar annulation')"
                                @click="$emit('action', 'ar annulation')">
                            AR Annulation
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('envoyé changement sur option')"
                                @click="$emit('action', 'envoyé changement sur option')">
                            Envoyé changement sur option
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('envoyé changement sur confirmation')"
                                @click="$emit('action', 'envoyé changement sur confirmation')">
                            Envoyé changement sur confirmation
                        </button>
                        <button class="uppercase hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :class="trainingStore.bgColorActionCustomer('envoyé refus')"
                                @click="$emit('action', 'envoyé refus')">
                            Envoyé refus
                        </button>
                        <button class="bg-red-500 uppercase hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="$emit('close')">
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
