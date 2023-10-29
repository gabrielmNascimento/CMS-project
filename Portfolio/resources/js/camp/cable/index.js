import { ref, watch } from 'vue'
import { useGeneric } from '../generic'
import { getTurles } from '../../types/turles_cables'

const cables = ref([])

export const useIndex = () => {
    const { variables, state, buildURL, route } = useGeneric()
    const thead = ref([
        { title: 'Ordem', column: 'ordem', direction: 'desc', sortable: true },
        { title: 'Turles Cable', column: 'turles_cable', direction: 'desc', sortable: true },
        { title: 'Enhanced', column: 'enhanced_list', direction: 'desc', sortable: false },
        { title: 'Inherents', column: 'inherent_list', direction: 'desc', sortable: false },
        { title: 'Eros', column: 'eros_list', direction: 'desc', sortable: false },
        { title: '', column: '', direction: '', sortable: false, style: 'three-actions' }
    ])
    
    const index = async () => {
        const column = `&column=${state.params.column}`
        let aux = 0 
        if (String(route.params.id).includes('l')){
            aux = 0
        }
        else {
            aux = route.params.id
        }
        const interior_id = `&interior_id=${aux}`
        const response = await axios.get(buildURL('cables', `${column}${interior_id}`))
        if(response){
            cables.value = response.data.cables.data
            state.params = response.data.params
        }else{
            cables.value = []
            state.params = []
        }
    }

    const setElement = (element) => {
        variables.id = element.id
        variables.path = 'cables'
        variables.text = element.id
    }

    const deleteAll = async () => {
        const response = await axios.delete(`api/inherents/${route.params.id}/cables`)
        if(response.data.success)
            index()
    }

    watch(() => route.params.id, (id, prevId) => {
        if(id)
            index()
    })

    return { thead, cables, state, setElement, index, deleteAll, getTurles }
}
