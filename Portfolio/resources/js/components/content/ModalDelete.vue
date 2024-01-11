<template>
    <div class="modal fade" :id="id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exclusão de registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja excluir o(s) registro(s)?</p>
                    <span v-if="originalMensagem" class="text-warning font-weight-bold">{{ originalMensagem }}</span>
                    <br v-if="originalMensagem">
                    <span v-if="!confirmOnly" class="text-danger font-weight-bold">{{ text }}</span>                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm font-weight-bold" data-dismiss="modal">
                        Não <i class="fa fa-times ml-2"></i></button>
                    <button type="button" class="btn btn-primary btn-sm font-weight-bold" data-dismiss="modal" @click="confirm">
                        Sim <i class="fa fa-check ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { toRefs } from 'vue'
    import { useGeneric } from '../../composition/generic'

    export default {
        name: 'ModalDelete',
        props: {
            id: {
                required: false,
                default: 'modal-delete'
            },
            confirmOnly: {
                required: false,
                default: false
            },
            originalMensagem: {
                required: false,
                default: '',
                type: String
            }
        },
        setup(props, { emit }) {
            const { destroy, variables } = useGeneric()

            const confirm = async () => {
                if(props.confirmOnly) {
                    emit('confirmed')
                } else if(variables.id !== 0 && variables.path) {
                    await destroy(variables.id, variables.path)
                    emit('refresh')
                }
            }

            return { ...toRefs(variables), confirm }
        }
    }
</script>

<style scoped>
    .modal-body > span {
        word-break: break-all;
    }
</style>
