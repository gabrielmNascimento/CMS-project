<template>
    <input type="text" class="form-control" v-model="value" :class="[error ? 'is-invalid' : '']" autocomplete="off"
           v-inputmask data-inputmask-mask="9" :data-inputmask-repeat="length" data-inputmask-greedy="false"
            data-inputmask-showMaskOnHover="false" @paste="onPaste">
</template>

<script>
    import { computed } from 'vue'
    import inputmask from '../../directives/inputmask'

    export default  {
        name: 'Integer',
        directives: {
            inputmask
        },
        props: {
            error: {
                type: Array
            },
            modelValue: {
                type: [String, Number],
                default: ''
            },
            length: {
                type: Number,
                required: false,
                default: 9
            }
        },
        setup(props, {emit}) {
            const value = computed({
                get: () => props.modelValue,
                set: value => {
                    emit('update:modelValue', value)
                }
            })
            const onPaste = (e) => {
                setTimeout(() => {
                    value.value= document.getElementById(e.target.id).value
                }, 200)

            }
            return { value, onPaste }
        }
    }
</script>
