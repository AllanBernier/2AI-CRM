import { defineStore} from "pinia";

export const useCustomerStore = defineStore({
    id: 'customers',
    state: () => ({
        customers: "not defined"
    }),
    getters: {},
    actions: {
        getCustomersIfNotLoaded(){
            console.log("here")
            if (this.customers === "not defined") {
                axios.get(route('customers.all')).then( (res) => {
                    this.customers = res.data.data;
                    this.customers.forEach( (p) => {
                        p.name = p.first_name + " "+ p.last_name
                    })
                    console.log(this.customers)
                })
            }
        },
    }
})
