import { reactive, toRefs, onMounted} from 'vue'
import { useOlBasic } from './olBasic'
const { map } = useOlBasic()

export const useOlLayerSwitcher = () => {
    const layers = reactive({
        items: [],
        all: [],
        base: [],
        selected: 0
    })

    onMounted(async () => {
        setTimeout(() => {
            layers.all = map.value.getLayers().getArray()

            layers.all.forEach(function (l) {
                if(l.get('baseLayer')) {
                    layers.items.push(l.get('title'))
                    layers.base.push(l)
                }
            })
            // watch([layers,layers.all,layers.base,layers.items,layers.selected],() =>{
            //     console.log(1)
            //     atualisacaoInfo()
            // })
        }, 100)
    })

    const changeLayer = () => {
        layers.base.forEach((l) => {
            l.setVisible(false)
        })
        layers.base[layers.selected].setVisible(true)
    }
    return { ...toRefs(layers), changeLayer }
}
