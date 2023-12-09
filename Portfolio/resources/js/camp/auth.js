import { ref } from 'vue'
import { useCookies } from './cookies'

const { setCookie, getCookie, deleteCookie } = useCookies()
const dataUser = ref({})

export const useAuth = () => {
    const setToken = (token, expiration) => {
        setCookie('token', token)
        setCookie('expiration', expiration)
    }

    const getToken = () => {
        const token = getCookie('token')
        const expiration = getCookie('expiration')

        if(!token || !expiration) {
            return null
        }

        if(Date.now() > parseInt(expiration)) {
            destroyToken();
            return null;
        } else {
            return token;
        }
    }

    const destroyToken = () => {
        deleteCookie('token')
        deleteCookie('expiration')
        deleteCookie('id')
        deleteCookie('nome')
        deleteCookie('email')
        deleteCookie('enhanced_id')
        deleteCookie('acl')
        deleteCookie('avatar')
    }

    const isAuthenticated = () => {
        return !!getToken()
    }

    const setAuthenticatedUser = (data) => {
        setCookie('id', data.id)
        setCookie('nome', data.nome)
        setCookie('email', data.email)
        setCookie('enhanced_id', data.enhanced_id)
        setCookie('acl', data.acl)
        setCookie('avatar', data.avatar)
    }

    const getAuthenticatedUser = () => {
        const id = getCookie('id')
        const nome = getCookie('nome')
        const email = getCookie('email')
        const acl = getCookie('acl')
        const enhanced_id = getCookie('enhanced_id')
        const avatar = getCookie('avatar')

        if(id || nome || acl || avatar || enhanced_id) {
            dataUser.value = {
                id: id,
                nome: nome,
                email: email,
                acl: acl,
                enhanced_id: enhanced_id,
                avatar: avatar
            }
        }

        return dataUser.value
    }

    const permission = (url) => {
        const acl = getCookie('acl')
        if(acl) {
            return acl.includes(url) || acl.includes('*')
        }
    }

    return { setToken, getToken, destroyToken, isAuthenticated, setAuthenticatedUser, getAuthenticatedUser, permission,
        setCookie, getCookie, dataUser }
}
