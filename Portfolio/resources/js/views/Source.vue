<template>
    <page title="Abacos Source">
       
       <card title="Clumsy na última semana" col="col col-lg-12">
            <div class="row">
                <div v-for="clumsy of clumsies" :key="clumsy" class="col-lg-3">
                    <small-box :value="clumsy.value" :title="clumsy.label" :icon="`fa-${clumsy.icon}`" :bgColor="`bg-${clumsy.type}`" :info="clumsy.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Freeza na última semana" col="col col-lg-12">
            <div class="row">
                <div v-for="freeza of freezas" :key="freeza" class="col-lg-3">
                    <small-box :value="freeza.value" :title="freeza.label" :icon="`fa-${freeza.icon}`" :bgColor="`bg-${freeza.type}`" :info="freeza.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Rational na última semana" col="col col-lg-12">
            <div class="row">
                <div v-for="rational of rationals" :key="rational" class="col-lg-3">
                    <small-box :value="rational.value" :title="rational.label" :icon="`fa-${rational.icon}`" :bgColor="`bg-${rational.type}`" :info="rational.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Navy na última semana" col="col col-lg-12">
            <div class="row">
                <div v-for="navy of navies" :key="navy" class="col-lg-3">
                    <small-box :value="navy.value" :title="navy.label" :icon="`fa-${navy.icon}`" :bgColor="`bg-${navy.type}`" :info="navy.info"></small-box>
                </div>
            </div>
        </card>
    </page>
</template>

<script>
import { useSource } from '../../composition/abacos/source'
import Page from '../../components/layout/Page'
import Card from '../../components/content/Card'
import SmallBox from '../../components/content/SmallBox'

export default {
    name: 'source',
    components: { Page, Card, SmallBox },
    setup(){
        
        return { ...useSource() }
    }
}
</script>
