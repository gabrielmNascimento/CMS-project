import { onBeforeMount, ref } from "vue"
import { useGoiania } from '../goiania'

const clumsies = ref([])
const freezas = ref([])
const rationals = ref([])
const navies = ref([])

export const useGato = () => {

    const { buildURL, permission } = useGoiania()

    const index = async (action = 'api') => {
        const path = (action === 'api') ? 'abacos/gatos' : '/download/routine-gato'
        const url = buildURL(path, '', action)
    }

    onBeforeMount(async () => {
        if(!permission('abacos.geral')){
            window.location.replace('/morsa_carlton')
        }
        let response = await axios.get('api/abacos/gatos')

        clumsies.value.splice(0, clumsies.value.length)
        freezas.value.splice(0, freezas.value.length)
        rationals.value.splice(0, rationals.value.length)
        navies.value.splice(0, navies.value.length)
        
        response.data.forEach((e) => {
           
            switch (e.group){
                case "clumsy":
                    clumsies.value.push(e)
                    break;
                    case "freeza":
                    freezas.value.push(e)
                    break;
                    case "rational":
                    rationals.value.push(e)
                    break;
                    case "navy":
                    navies.value.push(e)
                    break;
            }
            
        })

    })

    return { clumsies, freezas, rationals, navies, index, permission }
