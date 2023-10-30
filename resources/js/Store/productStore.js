import { defineStore} from "pinia";

export const useProductStore = defineStore({
    id: 'products',
    state: () => ({
        products: "not defined"
    }),
    getters: {},
    actions: {
        getProductsIfNotLoaded(){
            console.log("here")
            if (this.products === "not defined") {
                axios.get(route('products.all')).then( (res) => {
                    this.products = res.data.data;
                    this.products.forEach( (p) => {
                        p.name = p.code + ", "+ p.company.name
                    })
                    console.log(this.products)
                })
            }
        },
    }
})
