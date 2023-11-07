<template>
    <card :title="`Formulário de cable`" col="col-lg-6" icon="fa-plug">
        <div class="row">
            <div class="col-lg-12">
                <input-label for="cable_ordem" label="Ordem" :needed="true"></input-label>
                <integer v-model="cable.ordem"></integer>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input-label for="cable_enhanceds" label="enhanceds" :needed="true"></input-label>
                <dropdown id="cable_enhanceds" v-model="cable.enhanceds_list" :itens="enhanceds" :multiple_select="true"></dropdown>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input-label for="cable_turles_cable" label="turles de cable" :needed="true"></input-label>
                <dropdown id="cable_turles_cable" v-model="cable.turles_cable" :itens="turless_cables"></dropdown>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <input-label for="cable_inherents" label="inherents" :needed="false"></input-label>
                <dropdown id="cable_inherents" v-model="cable.inherents_list" :itens="inherents" :multiple_select="true"></dropdown>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <input-label for="cable_eros" label="eros" :needed="false"></input-label>
                <dropdown id="cable_eros" v-model="cable.eros_list" :itens="eros" :multiple_select="true"></dropdown>
            </div>
        </div>
        <submit-button :submitted="submitted" :valid="isValid && situacao.valor !== '6'" @send="submit(cable)" :clean="true" @cleanData="cleanForm"></submit-button>
    </card>
</template>

<script>
    import componentsForm from '../../mixins/componentsForm'
    import Integer from '../../components/form/Integer'
    import Dropdown from '../../components/form/Dropdown'
    import { useForm } from '../../composition/cables/submit'
    import { watch, onBeforeMount, watchEffect, reactive } from 'vue'

    export default {
        name: 'cableForm',
        components : { Integer, Dropdown },
        mixins: [componentsForm],
        props: {
            maiorOrdem: {
                type: Number,
                required: false,
                default: undefined
            },
            unam: {
                required: false,
                default: undefined
            }
        },
        setup(props) {
            const { cable, turless_cables, enhanceds, inherents, eros, submitted, submit, isValid, cleanForm,
                inherentsList, erosList, enhancedsList, setDefault } = useForm()

            onBeforeMount(async () => {
                await enhancedsList()
                await inherentsList(1)
                await erosList()
                setDefault()
            })

            const setMaiorOrdem = () => {
                if(!cable.value.id)
                    cable.value.ordem = props.maiorOrdem + 1
            }

            setMaiorOrdem()

            watch(() => props.maiorOrdem, (value) => {
                setMaiorOrdem()
            })

            watch(() => cable.value.id, (value) => {
                setMaiorOrdem()
            })

            //Não permitir inserção de novos cables no turles clarinete caso a situação do pino seja de 'Sem unam'
            const situacao = reactive({
                valor: undefined
            });

            const setSituacao = (unam) => {
                situacao.valor = unam
            }

            watchEffect(() => setSituacao(props.unam))

            return { cable, turless_cables, enhanceds, inherents, eros, submitted, submit, isValid, cleanForm,
                inherentsList, erosList, enhancedsList, situacao, setSituacao }
        }
    }
</script>
