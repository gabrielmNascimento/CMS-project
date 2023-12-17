import 'ol/ol.css'
import Map from 'ol/Map'
import View from 'ol/View'
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { unByKey } from 'ol/Observable'
import { defaults as defaultControls, ZoomToExtent, ScaleLine, ZoomSlider, MousePosition, FullScreen } from 'ol/control.js'
import { useOlOverviewMap } from './olOverviewMap'

const map = ref(null)
const mapKey = ref(null)
const view = ref(null)

export const useOlBasic = (id, center, projection, zoom, minZoom, maxZoom, extent) => {
    const { overviewMapControl } = useOlOverviewMap()

    onMounted(async () => {
        map.value = new Map({
            controls: defaultControls().extend([
                new ScaleLine({
                    units: 'metric'
                }),
                new ZoomSlider(),
                new MousePosition(),
                new FullScreen(),
                new ZoomToExtent({
                    tipLabel: 'Enquadramento inicial',
                    extent: extent
                }),
                overviewMapControl
            ])
        })

        view.value = new View({
            center: center,
            projection: projection,
            zoom: zoom,
            minZoom: minZoom,
            maxZoom: maxZoom
        })

        map.value.setTarget(id)
        map.value.setView(view.value)
    })

    onBeforeUnmount(() => {
        if (map.value !== null){
            // console.log("matando mapa")
            map.value.setTarget(null)        
            map.value = null     
        }            
    })

    const clear = () => {
        if(mapKey.value) {
            unByKey(mapKey.value)
        }
    }

    const redraw = () => {
        map.value.updateSize();
    }

    return { map, view, clear, redraw }
}
