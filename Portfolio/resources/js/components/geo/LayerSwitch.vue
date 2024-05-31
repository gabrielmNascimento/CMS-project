<template>
    <div>
        <p class="text-uppercase font-italic mb-2">Camadas base</p>
        <div class="col-md-12" v-for="(item, i) in items" :key="i">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" :id="`baseLayer_${i}`"
                    :value="i" v-model="selected" @change="changeLayer">
                <label :for="`baseLayer_${i}`" class="custom-control-label">{{ item }}</label>
            </div>
        </div>
    </div>

</template>

<script>
    import { useOlLayerSwitcher } from '../../composition/geo/olLayerSwitcher'

    export default {
        name: 'LayerSwitcher',
        setup() {
            return { ...useOlLayerSwitcher() }
        }
    }
</script>
