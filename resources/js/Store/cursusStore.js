import { defineStore} from "pinia";
import axios from "axios";

export const useCursusStore = defineStore({
    id: 'cursus',
    state: () => ({}),
    getters: {},
    actions: {
        updateCol(value, cursus, col){
            cursus[col] = value
            axios.put(route('cursuses.edit', cursus.id), cursus)
        },
        async createCursus(name) {
            return axios.post(route('cursuses.store'), { name: name}).then((res) => {
                return res.data.data;
            })
        }
    }
})
