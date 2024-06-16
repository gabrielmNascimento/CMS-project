<template>
    <li class="nav-item dropdown">
        <a class="nav-link img-nav" data-toggle="dropdown">
            <img :src="`/avatar/${dataUser.avatar}`" class="img-circle elevation-2"
                 :title="dataUser.nome" :alt="dataUser.nome">
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <router-link class="dropdown-item profile-nav" to="minha_conta">Minha conta</router-link>
            <div class="dropdown-divider"></div>
            <router-link class="dropdown-item profile-nav" to="minha_senha">Minha senha</router-link>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item dropdown-footer" @click.prevent="logoutUser">
                <i class="fas fa-power-off mr-1"></i> Desconectar</a>
        </div>
    </li>
</template>

<script>
    import { ref } from 'vue'
    import { useAuth } from '../../../composition/auth'
    import { useCookies } from '../../../composition/cookies'

    export default {
        name: 'Profile',
        props: {
            dataUser: {
                required: true
            }
        },
        setup() {
            const id = ref(0)
            const { destroyToken } = useAuth()
            const { getCookie } = useCookies()
            const logoutUser = () => {
                if(getCookie('id')) {
                    id.value = getCookie('id')
                }

                destroyToken()
                axios.post('api/logout', {id: id.value})
                    .then(function (response) {
                        window.location.href = response.data.url
                    })
                 window.localStorage.clear()
            }

            return { logoutUser }
        }
    }
</script>
