import { defineStore} from "pinia";
import dayjs from "dayjs";

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
        },
        updateDate(start, end, training){
            training['start_date'] = start
            training['end_date'] = end
            axios.put(route('trainings.edit', training.id), training)
        },
        totalHT(training){
            return ((training.tjm_client + training.travelling_expenses) * training.duree).toFixed(2)
        },
        totalSubcontractor(training){
            return ((training.tjm_subcontractor + training.travelling_expenses) * training.duree).toFixed(2)
        },
        margeEur(training){
            return (this.totalHT(training) - this.totalSubcontractor(training)).toFixed(2)
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
                case "archivé":
                    return "bg-red-100"
                default:
                    return "bg-red"
            }
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
                    this.trainings.unshift(res.data.data)
                })
        }
    }
})
