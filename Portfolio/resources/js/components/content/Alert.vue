<template>
    <div v-if="messageDisplay && display" class="alert w-100" :class="`alert-${alerts.status}`">
        <button type="button" class="close" @click="display=false" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i :class="`icon fas fa-${alerts.icon}`"></i> {{ alerts.title }}</h5>
        <p>{{ message }}</p>
        <p v-for=" ( messages ) in msgArrayLimpo" :key="messages[1]">
            - {{messages [0]}}
        </p>
    </div>
</template>

<script>
import { ref, watchEffect } from 'vue'

    export default {
        name: 'Alert',
        props: {
            alerts: {
                type: Object
            },
            message: {
                type: String,
                required: false
            },
            messageArray: {
                type: Array,
                required: false
            },
            display: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        setup(props) {
            const messageDisplay = ref(true)
            const msgArrayLimpo = ref([])

            watchEffect(() => {

                if(!props.message && !props.messageArray){
                    messageDisplay.value = false
                }else{
                    messageDisplay.value = true
                }

            })

            watchEffect(() => {
                msgArrayLimpo.value = []
                if(props.messageArray){
                    props.messageArray.forEach((messages,i) => {
                        msgArrayLimpo.value.push([messages,i])
                    });
                }
            })

            return { messageDisplay,msgArrayLimpo }
        }
    }

</script>
