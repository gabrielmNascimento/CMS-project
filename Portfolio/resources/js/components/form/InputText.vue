<template>
    <input type="text" class="form-control" :readonly="disable" autocomplete="off" v-model="value" :class="[error ? 'is-invalid' : '']">
</template>

<script>
    import { computed } from 'vue'

    export default  {
        name: 'InputText',
        props: {
            error: {
                type: Array
            },
            modelValue: {
                type: String,
                default: ''
            },
            disable: {
                type: Boolean,
                default: false
            }
        },
        setup(props, {emit}) {
            const value = computed({
                get: () => props.modelValue,
                set: value => {
                    emit('update:modelValue', value)
                }
            })
            return { value }
        }
    }
</script>
