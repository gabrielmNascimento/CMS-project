<template>
    <div class="form-group">
        <slot></slot>
        <small class="text-danger" v-if="error">{{ error[0] }}</small>
    </div>
</template>

<script>
    export default {
        name: 'FormError',
        props: {
            error: {
                type: Array
            }
        }
    }
</script>
