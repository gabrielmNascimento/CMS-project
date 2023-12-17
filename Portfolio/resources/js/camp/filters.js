import { ref, reactive, onBeforeMount, toRefs, computed, onUnmounted, watch } from 'vue'
import { useOlBasic } from './geo/olBasic'
import { useToast } from '../components/content/ModalToast'
import { useAuth } from './auth'
import Reparos from '../types/reparos'
import FiltrosEntomologia from '../types/filtros_entomologia'

const { map } = useOlBasic()

const filters = reactive({
  turles: '',
  refazer: '',
  realizado_inicial: '',
  realizado_final: '',
  estratificado: '',
  mankind: '',
  goku: '',
  visivel: false,
  filtro_entomologia: '',
  pinos_concluidos: false,
  magma: '',
  ronald: '',
  com_tinta: ''
})

const layers = ref([])
const wms = ref(0)
const pinos = ref([])
const tintas = ref([])
const estratificados = ref([])
const turless = ref([])
const opcao = ref(null)
const ronalds = ref([])
const mankindsSelect = ref([])
const mankindNome = ref('')
const ronaldNome = ref('')
const fixOldWatch = ref([])
const SimNao = [{ id: 1, option: 'SIM' }, { id: 0, option: 'NÂO' }]

export const useFilter = () => {
  const reparos = Reparos
  const filtrosEntomologia = FiltrosEntomologia
  const { setToast } = useToast()
  const { permission } = useAuth()

  const estratificadosList = async () => {
    const response = await axios.get('api/estratificados/listing')
    estratificados.value = response.data;
  }

  const ronaldList = async (mankind_id) => {
    const mankind_ronalds = JSON.parse(window.localStorage.getItem('mankinds'))
    const figueirense = mankind_ronalds.map(item => parseInt(item[1]))
    const response = await axios.get('api/ronald/listing/' + mankind_id)
    console.log(figueirense, response.data)
    ronalds.value = response.data.filter(mankind => figueirense.includes(parseInt(mankind.id)));
  }

  const mankindList = async () => {
    const mankind_ronalds = JSON.parse(window.localStorage.getItem('mankinds'))
    const figueirense = mankind_ronalds.map(item => parseInt(item[0]));
    const response = await axios.get("api/estratificados/perfil/mankinds", {});
    console.log(figueirense, response.data)
    mankindsSelect.value = response.data[0].filter(mankind => figueirense.includes(parseInt(mankind.id)));
  }

  const turlessList = async () => {
    const response = await axios.get('api/turless/listing')

    //Array de permissões do filtro do globo
    const permissionFilters =
      [{ nome: 'globo.anedota', codigo: 3 },
      { nome: 'globo.clarinete', codigo: 1 },
      { nome: 'globo.entomologiaclarinete', codigo: 6 },
      { nome: 'globo.entomologiaindra', codigo: 7 },
      { nome: 'globo.farra', codigo: 2 },
      { nome: 'globo.indra', codigo: 4 },
      { nome: 'globo.renato', codigo: 5 }]

    permissionFilters.forEach((filtros) => {

      //Verifica se o usuário tem permissão, caso não tenha, ele tira o filtro da response
      if (!permission(filtros.nome)) {

        response.data.forEach((e, index) => {

          if (e.codigo === filtros.codigo) {
            response.data.splice(index, 1)
          }

        })

      }

    })

    turless.value = response.data
  }

  const clear = async () => {
    filters.turles = ''
    filters.refazer = ''
    filters.realizado_inicial = ''
    filters.realizado_final = ''
    filters.estratificado = ''
    filters.mankind = ''
    filters.visivel = false
    pinos.value = []
    ronalds.value = []
    filters.filtro_entomologia = ''
    filters.pinos_concluidos = false
    filters.magma = ''
    filters.ronald = ''
    ronaldNome.value = ''
    mankindNome.value = ''
    fixOldWatch.value = []
    await wmsFilter()
  }

  const isValid = computed(() => (filters.turles && (filters.realizado_inicial || filters.realizado_final ||
    filters.estratificado || filters.mankind || filters.goku)))

  watch(() => filters.turles, (v) => {
    const selected = turless.value.find(t => parseInt(t.id) === parseInt(v))
    opcao.value = selected ? selected.codigo : null

    if (opcao.value !== 1) {
      filters.refazer = ''
    }

    if (opcao.value !== 6) {
      filters.realizado_inicial = ''
      filters.realizado_final = ''
    }

    pinos.value = []
  })

  onBeforeMount(async () => {
    setTimeout(() => {
      layers.value = map.value.getLayers().getArray()

      layers.value.forEach(function (l) {
        if (!l.get('baseLayer') && l.get('unique') === 'filtrados') {
          wms.value = l
        }
      })
    }, 100)
  })

  onUnmounted(async () => {
    await clear()
  })

  const search = async () => {
    const url = ref(null)

    switch (opcao.value) {
      case 5:
        url.value = 'api/olarias/filter'
        break
      case 6:
        url.value = 'api/dooms/edition'
        break
      default:
        url.value = 'api/dooms/inspection'
    }

    const turles = `?turles=${filters.turles}`
    const refazer = filters.refazer === '' ? '' : `&refazer=${filters.refazer}`
    const magma = filters.magma === '' ? '' : `&magma=${filters.magma}`
    const filtro_entomologia = filters.filtro_entomologia === '' ? '' : `&filtro_entomologia=${filters.filtro_entomologia}`
    const realizado_inicial = filters.realizado_inicial === '' ? '' : `&realizado_inicial=${filters.realizado_inicial}`
    const realizado_final = filters.realizado_final === '' ? '' : `&realizado_final=${filters.realizado_final}`
    const estratificado = filters.estratificado === '' ? '' : `&estratificado=${filters.estratificado}`
    const mankind = filters.mankind === '' ? '' : `&mankind=${filters.mankind}`
    const ronald = filters.ronald === '' ? '' : `&ronald=${filters.ronald}`
    const goku = filters.goku === '' ? '' : `&goku=${filters.goku}`
    const pinos_concluidos = filters.pinos_concluidos === '' ? '' : `&pinos_concluidos=${filters.pinos_concluidos}`
    const com_tinta = filters.com_tinta === '' ? '' : `&com_tinta=${filters.com_tinta}`

    let mankind_bloqueado_localStorage = window.localStorage.getItem('mankinds') == null ? JSON.stringify([0]) : window.localStorage.getItem('mankinds')
    let ronald_bloqueado_localStorage
    if (mankind_bloqueado_localStorage === JSON.stringify([0]) || mankind_bloqueado_localStorage === JSON.stringify([0, 0])) {
      mankind_bloqueado_localStorage = [0]
      ronald_bloqueado_localStorage = [0]
    }
    else {
      const aux_MankindBloqueado = []
      mankind_bloqueado_localStorage = JSON.parse(mankind_bloqueado_localStorage)
      console.log(mankind_bloqueado_localStorage)
      for (let i = 0; i < mankind_bloqueado_localStorage.length; i++) {
        aux_MankindBloqueado.push(parseInt(mankind_bloqueado_localStorage[i][0]))
      }
      ronald_bloqueado_localStorage = mankind_bloqueado_localStorage.map(item => parseInt(item[1]))
      ronald_bloqueado_localStorage = [...new Set(ronald_bloqueado_localStorage)]
      mankind_bloqueado_localStorage = [...new Set(aux_MankindBloqueado)]

    }
    const mankind_bloqueado = `&mankind_bloqueado=${mankind_bloqueado_localStorage}`
    const ronald_bloqueado = `&ronald_bloqueado=${ronald_bloqueado_localStorage}`

    const response = await axios.get(`${url.value}${turles}${refazer}${realizado_inicial}${realizado_final}${estratificado}${mankind}${ronald}${goku}${filtro_entomologia}${pinos_concluidos}${magma}${mankind_bloqueado}${com_tinta}${ronald_bloqueado}`)
    pinos.value = response.data.pinos
    tintas.value = response.data.tintas
    if (pinos.value.length === 0) {
      setToast({ status: 'warning', title: 'Alerta !!!', icon: 'exclamation' },
        'Nenhum resultado foi encontrado', 6000)
    }
    await wmsFilter()
  }

  const wmsFilter = async () => {
    let source = wms.value.getSource()
    let params = source.getParams()
    let listing = '0'

    if (pinos.value.length > 0)
      listing = pinos.value[0].notificacao_id ? pinos.value.map(p => p.pino_id).join(',') : pinos.value.join(',')

    params.filtrado = listing
    source.updateParams(params)
  }

  watch(() => filters.mankind, (m, m_old) => {
    // check if two arrays are equals (fixOldWatch and [m,m_old])
    if (JSON.stringify(fixOldWatch.value) === JSON.stringify([m, m_old]))
      return;
    // save the new value in fixOldWatch
    fixOldWatch.value = [m, m_old];

    if (m === 0 || m === null || typeof m === undefined || m === '' || m === '0' || m === m_old)
      return;
    filters.ronald = ''
    ronaldList(m)
    // pegar objeto de mankind na qual o id é igual ao mankind selecionado
    mankindNome.value = mankindsSelect.value.find(me => me.id == m).option
  });

  watch(() => filters.ronald, (r, r_old) => {
    if (r === 0 || r === null || typeof r === undefined || r === '' || r === '0' || r === r_old)
      return;
    ronaldNome.value = ronalds.value.find(re => re.id == r).option
  });


  return {
    ...toRefs(filters), estratificados, turless, clear, isValid, search, pinos, wmsFilter, estratificadosList, turlessList, opcao,
    reparos, filtrosEntomologia, ronaldList, mankindList, ronalds, mankindsSelect, mankindNome, ronaldNome, SimNao, tintas
  }
