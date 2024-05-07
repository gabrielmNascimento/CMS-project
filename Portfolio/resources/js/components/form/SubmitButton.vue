<template>
    <div class="text-center">
        <button v-if="submitted" type="button" class="btn btn-warning btn-sm font-weight-bold" disabled>
            Enviando <i class="fa fa-sync fa-spin ml-2"></i>
        </button>
        <button v-if="valid && !submitted" type="button" class="btn btn-sm" :class="classe" @click.prevent="submit">
            {{ label }}</button>
        <button v-if="clean" type="button" class="btn btn-default btn-sm ml-2" @click.prevent="cleanData">Limpar</button>
    </div>
</template>

<script>
    export default {
        name: 'SubmitButton',
        props: {
            classe: {
                required: false,
                type: String,
                default: 'btn-success'
            },
            label: {
                required: false,
                type: String,
                default: 'Salvar'
            },
            valid: {
                required: true
            },
            submitted: {
                required: true,
                type: Boolean
            },
            clean: {
                required: false,
                type: Boolean,
                default: false
            }
        },
        setup(props, {emit}) {
            const submit = () => {
                emit('send')
            }
            const cleanData = () => {
                emit('cleanData')
            }
            return { submit, cleanData }
        }
    }
</script>
