import OSM from 'ol/source/OSM'
import TileLayer from 'ol/layer/Tile'
import { OverviewMap } from 'ol/control'

export const useOlOverviewMap = () => {
    const overviewMapControl = new OverviewMap({
        layers: [
            new TileLayer({
                source: new OSM()
            }) ]
    })

    return { overviewMapControl }
}
