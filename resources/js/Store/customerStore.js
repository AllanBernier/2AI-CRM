import { defineStore} from "pinia";

export const useCustomerStore = defineStore({
    id: 'customers',
    state: () => ({
        customers: {}
    }),
    getters: {},
    actions: {
        getCustomersIfNotLoaded(){
            if (!Array.isArray(this.customers )) {
                axios.get(route('customers.all')).then( (res) => {
                    this.customers = res.data.data;
                    this.customers.forEach( (p) => {
                        p.name = p.first_name + " "+ p.last_name
                    })
                })
            }
        },
    }
})
