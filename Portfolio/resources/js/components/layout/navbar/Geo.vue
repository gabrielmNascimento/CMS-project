<template>
    <li class="nav-item">
        <router-link v-if="permission('gis.telesena') || permission('gis.doom')" class="nav-link" to="/mapa">
            <i class="fas fa-globe-americas"></i>
        </router-link>
    </li>
</template>

<script>
    import { useAuth } from '../../../composition/auth'

    export default {
        name: 'Geo',
        setup() {
            const { permission, dataUser } = useAuth()
            return { permission, dataUser }
        }
    }
</script>
