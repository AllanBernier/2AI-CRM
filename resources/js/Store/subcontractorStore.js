import { defineStore} from "pinia";

export const useSubcontractorStore = defineStore({
    id: 'subcontractors',
    state: () => ({
        subcontractors: {}
    }),
    getters: {},
    actions: {
        getSubcontractorsIfNotLoaded(){
            if (!Array.isArray(this.subcontractors )) {
                axios.get(route('subcontractors.all')).then( (res) => {
                    this.subcontractors = res.data.data;
                    this.subcontractors.forEach( (p) => {
                        p.name = p.first_name + " "+ p.last_name
                    })
                })
            }
        },
        updateCol(value, col, subcontractor){
            subcontractor[col] = value
            axios.put(route('subcontractors.edit', subcontractor.id), subcontractor)
        }
    }
})
