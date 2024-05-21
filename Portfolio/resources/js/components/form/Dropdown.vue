<template>
    <select ref="selectEl" class="form-control select2" :disabled="disabled" style="width: 100%" :multiple="multiple_select">
        <option v-if="!multiple_select"></option>
        <option v-for="item in itens" :value="item.id" :key="item.id">{{ item.option }}</option>
    </select>
</template>

<script>
    import { computed, ref, watch, onMounted, onBeforeUnmount,onUpdated } from 'vue'

    export default {
        name: 'Dropdown',
        props: {
            itens: {
                required: false,
            },
            multiple_select: {
                required: false,
            },
            disabled: {
                required: false,
                default: false
            },
            placeholder: {
                required: false,
                default: 'Selecione uma opção'
            },
            modelValue: {
                default: ''
            }
        },
        setup(props, {emit}) {
            const select2 = ref(null)
            const selectEl = ref(null)
            //const executado = ref(false);

            const option = computed({
                get: () => props.modelValue,
                set: value => {
                    emit('update:modelValue', value)
                }
            })

            watch(() => props.modelValue, (value) => {
                setTimeout(() => {
                    if (value instanceof Array) {
                        select2.value.val([...value]);
                    } else {
                        select2.value.val([value]);
                    }
                    select2.value.trigger('change');
                }, 300)
            })

            onMounted(() => {
                const el = $(selectEl.value)

                select2.value = el.select2({
                    placeholder: props.placeholder,
                    language: "pt-BR",
                    allowClear: true,
                    dropdownParent: el.parent()
                })
                .on('select2:select select2:unselect', () => {
                    option.value = select2.value.val()
                })
            })

            onBeforeUnmount(() => {
                if($(selectEl.value).data('select2')) {
                    select2.value.select2('destroy')
                }
            })

            /*onUpdated(() => {
                if (!executado.value && props.multiple_select) {
                    Array.from(document.getElementsByClassName("select2-selection__choice__remove")).forEach((e) => e.click());
                    executado.value = true;
                    console.log('executou')
                }
            });*/

            return { selectEl }
        }
    }
</script>
