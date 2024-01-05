<template>
    <div>
        <div class="row">
            <slot></slot>
            <button v-if="!hide" class="btn bg-navy btn-sm font-weight-bold ml-2" @click="search">
                Pesquisar <i class="fa fa-search ml-2"></i></button>
            <button v-if="!hide" class="btn btn-secondary btn-sm font-weight-bold ml-2" @click="clear">
                Limpar <i class="fa fa-eraser ml-2"></i></button>
        </div>
        <div class="text-danger font-weight-bold pt-3" v-if="!total && !displayLoading">Não há informações registradas no sistema.</div>
        
        <loader :loading="displayLoading"></loader>
    </div>
</template>

<script>
    import Loader from './Loader'

    export default {
        components: {
            Loader
        },
        props: {
            total: {
                required: true,
                type: Number
            },
            hide: {
                required: false,
                type: Boolean,
                default: false
            },
            displayLoading: {
                type: Boolean,
                default: false
            }
        },
        emits: ['loadSearch', 'clearSearch'],
        setup(props, { emit }) {
            const search = () => {
                emit('loadSearch')
            }

            const clear = () => {
                emit('clearSearch')
            }

            return { search, clear }
        }
    }
</script>

<style lang="css" scoped>
    .btn {
        margin-right: 5px;
    }
</style>
