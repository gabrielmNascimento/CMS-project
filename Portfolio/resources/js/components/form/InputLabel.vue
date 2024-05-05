<template>
    <label class="col-form-label">
        <span class="text-danger text-bold" v-if="needed">*</span> {{ empty ? '&nbsp;' : label }}{{ empty ? '' : ':' }}</label>
</template>

<script>
    export default  {
        name: 'InputLabel',
        props: {
            label: {
                type: String,
                required: true
            },
            needed: {
                type: Boolean,
                required: false,
                default: false
            },
            empty: {
                type: Boolean,
                required : false,
                default: false
            }
        }
    }
</script>
