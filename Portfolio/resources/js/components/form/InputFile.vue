<template>
    <div class="input-group" v-if="!arquivo.hash">
        <div class="custom-file">
            <input type="file" class="custom-file-input" :id="keyId" @change="createFile" :accept="types">
            <label class="custom-file-label" :for="keyId">Selecione um arquivo</label>
        </div>
        <small v-if="invalido" class="form-text text-danger w-100">{{ errorMsg }}</small>
    </div>
    <div class="media" v-else>
        <div class="mr-2">
            <i class="fa fa-2x mt-1" :class="iconFile"></i>
        </div>
        <div class="media-body">
            <span class="font-weight-bold d-block">{{ arquivo.original }}</span>
            <small>{{ $formatBytes(arquivo.tamanho) }}</small>
        </div>
        <button type="button" class="btn btn-danger btn-icon mt-1" @click.prevent="uploadNew">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</template>

<script>
    import { computed, ref } from 'vue'
    
    export default {
        name: 'InputFile',
        props: {
            error: {
                type: Array
            },
            modelValue: {
                type: Object
            },
            accept: {
                type: Array,
                default: []
            },
            keyId: {
                type: String,
                required: true
            },
            iconFile: {
                type: String,
                required: false,
                default: 'fa-file-alt'
            },
            errorMsg: {
                type: String
            }            
        },
        setup(props, { emit }) {
            const arquivo = computed({
                get: () => props.modelValue,
                set: (value) => {
                    emit('update:modelValue', value)
                }
            })

            const types = computed({
                get: () => props.accept.join(',')
            })

            const invalido = ref(false)

            const createFile = (e) => {
                console.log(e.target.files)
                let file = e.target.files[0]

                if(!file)
                    return

                if(props.accept.includes(file.type)) {
                    invalido.value = false 
                    
                    let reader = new FileReader()
                
                    reader.onloadend = () => {
                        console.log(file)
                        arquivo.value.original = file.name
                        arquivo.value.tamanho = file.size
                        arquivo.value.hash = reader.result
                    }

                    reader.readAsDataURL(file)
                } else {
                    invalido.value = true
                }
            }

            const uploadNew = () => {
                arquivo.value.hash = false
            }

            return { arquivo, invalido, types, createFile, uploadNew }
        } 
    }
</script>
