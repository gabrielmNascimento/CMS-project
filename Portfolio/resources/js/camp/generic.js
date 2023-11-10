import { ref, reactive, onBeforeUnmount, computed } from 'vue'
import { useCookies } from './cookies'
import { useRoute, useRouter } from 'vue-router'
import { useAuth } from './auth'

const message = ref(null)
const alerts = ref({})
const result = reactive({
    obj: {}
})

const variables = reactive({
    id: 0,
    path: '',
    text: ''
})

export const useGeneric = () => {
    const { setCookie, getCookie, deleteCookie } = useCookies()
    const { permission } = useAuth()
    const state = reactive({
        params: {
            total: 0,
            per_page: 30,
            current_page: 1,
            direction: 'asc'
        }
    })
    const submitted = ref(false)
    const success = ref(false)
    const errors = ref([])
    const router = useRouter()
    const route = useRoute()
    const title = computed(() => (route.params.id ? 'alteração' : 'inclusão'))

    const flashMessage = () => {
        message.value = getCookie('message') ? getCookie('message') : null
        alerts.value = getCookie('alerts') ? JSON.parse(getCookie('alerts')) : null
        deleteCookie('message')
        deleteCookie('alerts')
    }

    const submit = async (data, path, redirect = path,por_id_edit = false) => {
        submitted.value = true
        await router.isReady();
        // console.log(route.fullPath)
        // console.log(route.params)
        // console.log(router.currentRoute.params)
        // console.log(router.currentRoute.fullPath)
        const response = route.params.id  && !por_id_edit ? await axios.put(`api/${path}/${route.params.id}`, data)
            : await axios.post(`api/${path}`, data)
        success.value = response.data.success
        errors.value = response.data.errors ? response.data.errors : []
        message.value = response.data.message
        alerts.value = response.data.alerts
        // const responsevalue = response.data
        // console.log(responsevalue)
        // console.log(router)
        if(success.value && router) {
            setCookie('message', message.value)
            setCookie('alerts', JSON.stringify(alerts.value))
            // console.log(`/${redirect}/${message.value}/edit`)
            if (por_id_edit) window.location = `/${redirect}/${message.value}/edit`
            else router.push(`/${redirect}`)
        }

        submitted.value = false
    }

    const show = async (id, path) => {
        if(id) {
            const response = await axios.get(`api/${path}/${id}`)

            if(response.data.hasOwnProperty('success')) {
                setCookie('message', response.data.message)
                setCookie('alerts', JSON.stringify(response.data.alerts))
                router.push(`/${path}`)
            } else {
                result.obj = response.data
            }
        }
    }

    const destroy = async (id, path) => {
        if(id) {
            const response = await axios.delete(`api/${path}/${id}`)
            success.value = response.data.success
            message.value = response.data.message
            alerts.value = response.data.alerts
        }
    }

    const buildURL = (path, variables, action='api') => {
        const current_page = `?page=${state.params.current_page}`
        const per_page = `&per_page=${state.params.per_page}`
        const direction = `&direction=${state.params.direction}`
        if(action === 'api') {
            return `api/${path}${current_page}${per_page}${direction}${variables}`
        } else {
            window.open(`${path}${current_page}${per_page}${direction}${variables}&type=export`)
        }
    }

    onBeforeUnmount(() => {
        message.value = null
        alerts.value = {}
    })

    return { result, message, alerts, submitted, success, errors, state, variables, flashMessage, buildURL, submit, show, destroy,
        permission, route, title }
}
