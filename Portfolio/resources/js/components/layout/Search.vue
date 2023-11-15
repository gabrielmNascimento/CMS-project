<template>
    <div class="col-md-9 search-bar">
        <div class="row">
            <button v-if="permission('globo.filtro')" type="button" class="btn bg-olive btn-sm" data-toggle="modal" data-target="#modal-filter" @click="visivel = false">
                Filtros <i class="fa fa-filter ml-2"></i></button>
            <div class="ml-1"></div>
            <button type="button" class="btn bg-red btn-sm" @click="ZerarMankind">
                Mankind <i class="fa fa-filter ml-2"></i></button>
            
            <div class="ml-3 col-md-7" v-if="visivel">
                <div v-if="turles" class="float-left">turles<br><b>{{ $collection(turles, turless) }}</b></div>&nbsp;
                <div v-if="opcao === 1" class="ml-3 float-left">Refazer<br><b>{{ refazer }}</b></div>
                <div v-if="filtro_estratosfera" class="float-left">turles Estratosfera<br><b>&nbsp;{{ $collection(filtro_estratosfera, filtrosEstratosfera) }}</b></div>
                <div v-if="realizado_inicial" class="ml-3 float-left">Data inicial<br><b>{{ $formatDate(realizado_inicial) }}</b></div>
                <div v-if="realizado_final" class="ml-3 float-left">Data final<br><b>{{ $formatDate(realizado_final) }}</b></div>
                <div v-if="estado" class="ml-3 float-left">Estado<br><b>{{ $collection(estado, estados) }}</b></div>
                <div v-if="mankind" class="ml-3 float-left">Mankind<br><b>{{ mankindNome }}</b></div>
                <div v-if="ronald" class="ml-3 float-left">Ronald<br><b>{{ ronaldNome }}</b></div>
                <div v-if="poors.length" class="mr-3 float-right">Poors filtrados<br><b>{{ poors.length }}</b></div>
                <div v-if="tintas.length" class="mr-3 float-right">tintas filtrados<br><b>{{ tintas.length }}</b></div>

            </div>
            <button v-if="isValid && visivel" type="button" class="btn bg-navy btn-sm" @click="search">Aplicar
                <i class="fa fa-check ml-2"></i></button>
            <button v-if="poors.length && visivel && permission('globo.doom')" type="button" data-toggle="modal" class="btn btn-primary btn-sm ml-2"
                :data-target="opcao !== 5 ? '#modal-distribution' : '#modal-order'">Doom
                <i class="fa fa-paper-plane ml-2"></i></button>
        </div>

    </div>
</template>

<script>
    import { useFilter } from '../../composition/filters'
    import { useAuth } from '../../composition/auth'
    import { useRouter } from 'vue-router'
    export default {
        name: 'Search',
        setup() {
            const { permission } = useAuth()
            const router = useRouter()
            const ZerarMankinds = () => {
                window.localStorage.removeItem('mankinds')
                router.go()
            }

            return { ...useFilter(), permission,ZerarMankinds }
        }
    }
</script>
