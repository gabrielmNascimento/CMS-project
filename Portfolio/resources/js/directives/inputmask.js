import Inputmask from 'inputmask'

export default {
    mounted: function (el) {
        new Inputmask().mask(el)
    }
}
