<template>
    <card title="Listagem de cables" icon="fa-list">
        <app-filter :hide="true" :total="state.params.total">
        </app-filter>
        <template v-if="!noAction" v-slot:tools>
            <button type="button" class="btn btn-sm btn-danger"
                title="Remover Todos" data-toggle="modal" data-target="#modal-delete-all">Remover Todos
            </button>
        </template>
        <data-grid :thead="thead" :params="state.params" @loadData="index">
            <tr v-for="(cable, i) in cables" :key="i">
                <td>{{ cable.ordem }}</td>
                <td>{{ getTurles(cable.turles_cable) }}</td>
                <td>
                    <span v-for="enhanced in cable.enhanceds" :key="enhanced.id" class="badge badge-info mr-3">
                        {{ enhanced.nome }}
                    </span>
                </td>
                <td>
                    <span v-for="inherent in cable.inherents" :key="inherent.id" class="badge badge-info mr-3">
                        {{ inherent.descricao }}
                    </span>
                </td>
                <td>
                    <span v-for="ero in cable.eros" :key="ero.id" class="badge badge-info mr-3">
                        {{ ero.descricao }}
                    </span>
                </td>
                <td class="text-right">
                    <button v-if="!noAction" type="button" class="btn btn-sm btn-info ml-1"
                        title="Clonar" @click.prevent="setCable(cable.id, true)"><i class="fas fa-copy"/>
                    </button>
                    <button v-if="!noAction" type="button" class="btn btn-sm bg-purple ml-1"
                        title="Editar" @click.prevent="setCable(cable.id)"><i class="fas fa-pencil-alt"/>
                    </button>
                    <button v-if="!noAction" type="button" class="btn btn-sm btn-danger ml-1"
                        title="Remover" data-toggle="modal" data-target="#modal-delete" @click.prevent="setElement(cable)"><i class="fas fa-trash"/>
                    </button>
                </td>
            </tr>
        </data-grid>
    </card>
    <modal-delete @refresh="indexAndClean"></modal-delete>
    <modal-delete :confirmOnly="true" id="modal-delete-all" @confirmed="deleteAllAndClean"></modal-delete>
</template>

<script>
    import { onBeforeMount } from 'vue'
    import componentsIndex from '../../mixins/componentsIndex'
    import { useIndex } from '../../composition/cables/index'
    import { useForm } from '../../composition/cables/submit'

    export default {
        name: 'cableIndex',
        mixins: [componentsIndex],
        props: {
            noAction: {
                type: Boolean,
                required: false,
                default: false
            },
            unam: {
                required: false,
                default: undefined
            }
        },
        emits: ["cleanSituacao"],
        setup( props, { emit }) {
            const { state, thead, cables, setElement, index, deleteAll, getTurles } = useIndex()
            const { setCable } = useForm()

            onBeforeMount(() => {
                state.params.column = 'ordem'
                state.params.direction = 'desc'
                index()
            })

            const indexAndClean = async () => {
                index()
                if(state.params.total === 1 && props.unam === '2')
                {
                    emit('cleanSituacao')
                }
            }

            const deleteAllAndClean = async () => {
                deleteAll()
                if( props.unam === '2' )
                {
                    emit('cleanSituacao')
                }
            }
            
            return { state, thead, cables, setElement, index, deleteAll, getTurles, setCable, deleteAllAndClean, indexAndClean }
        }
    }
</script>
