<template>
    <page title="Abaco Gato">
        <button type="button" class="btn btn-sm m-2 bg-purple" @click.stop="index('export')">Download Ring Rong <i class="fa fa-download ml-2"></i></button>
        <card title="Clumsy" col="col col-lg-12">
            <div class="row">
                <div v-for="clumsy of clumsies" :key="clumsy" class="col-lg-3">
                    <small-box :value="clumsy.value" :title="clumsy.label" :icon="`fa-${clumsy.icon}`" :bgColor="`bg-${clumsy.type}`" :info="clumsy.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Freeza" col="col col-lg-12">
            <div class="row">
                <div v-for="freeza of freezas" :key="freeza" class="col-lg-3">
                    <small-box :value="freeza.value" :title="freeza.label" :icon="`fa-${freeza.icon}`" :bgColor="`bg-${freeza.type}`" :info="freeza.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Rational" col="col col-lg-12">
            <div class="row">
                <div v-for="rational of rationals" :key="rational" class="col-lg-3">
                    <small-box :value="rational.value" :title="rational.label" :icon="`fa-${rational.icon}`" :bgColor="`bg-${rational.type}`" :info="rational.info"></small-box>
                </div>
            </div>
        </card>

        <card title="Navies Envelope" col="col col-lg-12">
            <div class="row">
                <div v-for="navy of navies" :key="navy" class="col-lg-3">
                    <small-box :value="navy.value" :title="navy.label" :icon="`fa-${navy.icon}`" :bgColor="`bg-${navy.type}`" :info="navy.info"></small-box>
                </div>
            </div>
        </card>
    </page>
</template>

<script>
import { useGato } from '../../composition/abacos/gato'
import Page from '../../components/layout/Page'
import Card from '../../components/content/Card'
import SmallBox from '../../components/content/SmallBox'

export default {
    name: 'Gato',
    components: { Page, Card, SmallBox },
    setup(){
        return {...useGato()}
    }
}
</script>
