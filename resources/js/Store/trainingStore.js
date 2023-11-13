import { defineStore} from "pinia";
import dayjs from "dayjs";
import axios from "axios";

export const useTrainingStore = defineStore({
    id: 'training',
    state: () => ({
        trainings: "not defined"
    }),
    getters: {},
    actions: {
        getTrainingsIfNotLoaded(){
            if (this.trainings === "not defined") {
                axios.get(route('trainings.all')).then( (res) => {
                    this.trainings = res.data.data;
                })
            }
        },
        updateCol(value, column, training){
            training[column] = value
            axios.put(route('trainings.edit', training.id), training)
                .then( (res) => {
                    let updated = res.data.data;
                    let id = this.trainings.findIndex( (t) => t.id === updated.id )
                    this.trainings[id] = updated
                })
        },
        updateDate(start, end, training){
            training['start_date'] = start
            training['end_date'] = end
            axios.put(route('trainings.edit', training.id), training)
        },
        totalHT(training){
            return (( parseFloat(training.tjm_client) + parseFloat(training.travelling_expenses)) * parseFloat(training.duree)).toFixed(2)
        },
        totalSubcontractor(training){
            return ((parseFloat(training.tjm_subcontractor) + parseFloat(training.travelling_expenses)) * parseFloat(training.duree)).toFixed(2)
        },
        margeEur(training){
            return (parseFloat(this.totalHT(training)) - parseFloat(this.totalSubcontractor(training))).toFixed(2)
        },
        totalPercent(training){
            return (this.margeEur(training) / this.totalHT(training) * 100).toFixed(2)
        },
        bgColorClass(training){
            switch(training.status) {
                case "nouveau":
                    return "bg-purple-200"
                case "option":
                    return "bg-amber-100"
                case "confirmé":
                    return "bg-lime-100"
                case "annulé":
                    return "bg-red-100"
                case "cursus":
                    return "bg-blue-100"
                default:
                    return "bg-red-500"
            }
        },
        bgColorStyle(training){
            switch(training.status) {
                case "nouveau":
                    return "#a855f7"
                case "option":
                    return "#f97316"
                case "confirmé":
                    return "#22c55e"
                case "annulé":
                    return "#991b1b"
                default:
                    return "#991b1b"
            }
        },
        bgColorActionCustomer (action) {
            switch (action){
                case "AR Nouveau":
                    return "bg-purple-600"
                case "Envoyé Intervenant":
                    return "bg-amber-600"
                case "Relance Option":
                    return "bg-lime-600"
                case "AR BDC":
                    return "bg-red-600"
                case "AR Annulation":
                    return "bg-red-600"
                case "Envoyé changement sur option":
                    return "bg-red-600"
                case "Envoyé changement sur confirmation":
                    return "bg-red-600"
                case "Envoyé refus":
                    return "bg-red-600"
                case "":
                    return "bg-gray-600"
                default:
                    return "bg-red"
            }
        },
        bgColorActionSubcontractor (action) {
            switch (action){
                case "Solliciter":
                    return "bg-gray-600"
                case "Solliciter dates":
                    return "bg-amber-600"
                case "Envoyé bon d'option":
                    return "bg-lime-600"
                case "Envoyé BDC":
                    return "bg-red-600"
                case "Bon pour accord":
                    return "bg-red-600"
                case "Annuler une option":
                    return "bg-red-600"
                case "Annuler une confirmation":
                    return "bg-red-600"
                case "":
                    return "bg-gray-600"
                default:
                    return "bg-red"
            }
        },
        formatSingleDate(date){
            return dayjs(date).isValid() ? dayjs(date).format('D MMM') : '-';
        },
        formatDate(training){
            if ( !dayjs(training.start_date).isValid() || !dayjs(training.end_date).isValid()){
                return '-'
            } else if (dayjs(training.start_date).format('MMM') === dayjs(training.end_date).format('MMM')){
                return dayjs(training.start_date).format('D') + ' - ' + dayjs(training.end_date).format('D MMM')
            } else {
                return dayjs(training.start_date).format('D MMM') + ' - ' + dayjs(training.end_date).format('D MMM')
            }
        },
        createTrainingByIdProduct(idProduct){
            let training_data = {
                product_id : idProduct
            }

            axios.post(route('trainings.store'), training_data )
                .then( (res) => {
                    console.log(res.data.data)
                    this.trainings.unshift(res.data.data)
                })
        },
        async createTraining(training_data) {

            console.log(training_data)

            return axios.post(route('trainings.store'), training_data )
            .then( (res) => {
                this.trainings.unshift(res.data.data)
                return res.data.data;
            })
        },
        destroy(training) {
            axios.delete(route('trainings.destroy',training.id) );
        },
        totalTrainingsSubcontractor(trainings){
            return Object.values(trainings).reduce((accumulator, training) => {
                return  parseFloat(accumulator) + parseFloat(this.totalSubcontractor(training));
            }, 0);

        },
        async arbdc(training){
            return axios.post(route('subcontractors.trainings.arbdc', training.id) )
                .then( (res) => {
                    return "done";
                })
        },
        async confirmSollicitation(training, action){
            return axios.post(route('subcontractors.trainings.confirm', training.id), {action : action} )
                .then( (res) => {
                    return "done";
                })
        }
    }
})
