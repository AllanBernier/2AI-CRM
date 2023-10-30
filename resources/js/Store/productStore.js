import { defineStore} from "pinia";

export const useTrainingStore = defineStore({
    id: 'products',
    state: () => ({
        products: "not defined"
    }),
    getters: {},
    actions: {
        getTrainingsIfNotLoaded(){
            if (this.products === "not defined") {
                axios.get(route('products.all')).then( (res) => {
                    this.products = res.data.data;
                })
            }
        },
    }
})
