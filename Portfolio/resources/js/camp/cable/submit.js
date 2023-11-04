import { computed, reactive, ref, toRefs } from 'vue'
import { useGeneric } from '../generic'
import { useIndex } from './index'
import Cable from '../../domain/cable'
import { getTurles } from '../../types/turles_cables'

const obj = reactive({
    cable: new cable()
})

export const useForm = () => {
    const { result, success, submitted, show, route } = useGeneric()
    const { index, state } = useIndex()
    const isValid = computed(() => (obj.cable.ordem && obj.cable.enhanceds_list.length > 0 && obj.cable.turles_cable))
    const enhanceds = ref([])
    const inherents = ref([])
    const eros = ref([])
    const turles_cables = TurlesCables
    

    const submit = async (data) => {
        submitted.value = true

        data.interior_id = route.params.id
        const response = data.id ? await axios.put(`api/cables/${data.id}`, data) : await axios.post(`api/cables`, data)
        success.value = response.data.success

        if(success.value) {
            obj.cable = new cable()
            state.params.direction = 'desc'
            state.params.column = 'ordem'
            index()
            setDefault()
        }

        submitted.value = false
    }

    const setCable = async (id, cloning = false) => {
        await show(id, 'cables')
        obj.cable = result.obj
        if(cloning)
            obj.cable.id = ''
    }

    const cleanForm = () => {
        obj.cable = new cable()
    }

    const setDefault = () => {
        obj.cable.turles_cable = 1
        obj.cable.enhanceds_list = ['1']
    }

    const enhancedsList = async (estratificado_id = null) => {
        const param = estratificado_id ? `/${estratificado_id}` : ''
        const response = await axios.get(`api/enhanceds/listing${param}`)
        enhanceds.value = response.data
    }

    const inherentsList = async (codigo, estratificado_id = null) => {
        const param = estratificado_id ? `/${codigo}/${estratificado_id}` : `/${codigo}`
        const response = await axios.get(`api/inherents/listing${param}`)
        inherents.value = response.data
    }

    const erossList = async () => {
        const response = await axios.get('api/eros/listing')
        eros.value = response.data
    }

    return { submitted, ...toRefs(obj), isValid, enhanceds, inherents, eros, submit, setCable, cleanForm,
        turless_cables, enhancedsList, inherentsList, erossList, setDefault }
}
