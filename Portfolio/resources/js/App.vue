<template>
    <div v-if="authenticated">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <search v-if="visible"></search>
            <ul class="navbar-nav ml-auto">
                <geo v-if="!dataUser.enhanced_id"></geo>
                <profile :data-user="dataUser"></profile>
                <control-sidebar v-if="visible" ></control-sidebar>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <logo></logo>
            <div class="sidebar">
                <user-panel :data-user="dataUser"></user-panel>
                <sidebar></sidebar>
            </div>
        </aside>
        <router-view/>
        <side-right v-if="visible"></side-right>
        <bottom></bottom>
    </div>
    <div v-else>
        <router-view name="login"/>
    </div>
</template>

<script>
    import { ref, onBeforeMount } from 'vue'
    import Bottom from './components/layout/Bottom'
    import SideRight from './components/layout/SideRight'
    import Search from './components/layout/Search'
    // import Messages from './components/layout/navbar/Messages'
    // import Notifications from './components/layout/navbar/Notifications'
    import Geo from './components/layout/navbar/Geo'
    import Profile from './components/layout/navbar/Profile'
    import ControlSidebar from './components/layout/navbar/ControlSidebar'
    import Logo from './components/layout/aside/Logo'
    import UserPanel from './components/layout/aside/UserPanel'
    import Sidebar from './components/layout/aside/Sidebar'
    import { useAuth } from './composition/auth'
    import { useEnableMap } from './composition/geo/enableMap'

    export default {
        name: 'App',
        components : {
            Bottom,
            SideRight,
            Search,
            // Messages,
            // Notifications,
            Geo,
            Profile,
            ControlSidebar,
            Logo,
            UserPanel,
            Sidebar
        },
        setup() {
            const { isAuthenticated, getAuthenticatedUser } = useAuth()
            const authenticated = ref(false)
            const dataUser = ref({})

            onBeforeMount(() => {
                authenticated.value = isAuthenticated()
                dataUser.value = getAuthenticatedUser()
            })

            return { authenticated, dataUser, ...useEnableMap() }
        }
    }
</script>
