<template>
    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="layer-tab" data-toggle="pill" href="#tabs-layer" role="tab"
                   aria-controls="tabs-layer" aria-selected="true"><i class="fas fa-layer-group fa-lg"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tools-tab" data-toggle="pill" href="#tabs-tools" role="tab"
                   aria-controls="tabs-tools" aria-selected="false"><i class="fas fa-tools fa-lg"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="label-tab" data-toggle="pill" href="#tabs-label" role="tab"
                   aria-controls="tabs-label" aria-selected="false"><i class="fas fa-info-circle"></i></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabs-layer" role="tabpanel" aria-labelledby="layer-tab">
                <layer-switcher></layer-switcher>
                <selector></selector>
            </div>
            <div class="tab-pane fade" id="tabs-tools" role="tabpanel" aria-labelledby="tools-tab">
                <toolbar></toolbar>
            </div>
            <div class="tab-pane fade" id="tabs-label" role="tabpanel" aria-labelledby="tools-tab">
                <info-layer></info-layer>
            </div>
        </div>
    </aside>
</template>

<script>
    import { onMounted } from 'vue'
    import LayerSwitcher from '../../components/geo/LayerSwitcher'
    import Selector from '../../components/geo/Selector'
    import Toolbar from '../../components/geo/Toolbar'
    import InfoLayer from '../../components/geo/InfoLayer'

    export default {
        name: 'SideRight',
        components: { LayerSwitcher, Selector, Toolbar, InfoLayer },
        setup() {
            onMounted(() => {
                const tools = $('#tabs-tools')
                tools.find('a').click(function () {
                    tools.find('a').removeClass('active')
                    $(this).addClass('active')
                })
            })
        }
    }
</script>
