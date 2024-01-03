<template>
    <div class="table-responsive p-0 mt-3" v-if="params.total !== 0">
        <table class="table table-hover table-sm" :class="{'text-nowrap': noWrap}">
            <thead>
                <tr class="table-active">
                    <th v-for="(item, i) in thead" :class="item.style ? item.style : null" :key="i">
                        <div v-if="item.sortable" @click="sort(item.column)" :class="sortClass(item)">
                            {{ item.title }}
                        </div>
                        <div v-else>
                            {{ item.title }}
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td :colspan="thead.length" class="font-weight-bold" v-if="params.total >= 0 && !noParams">
                        Total cadastrado
                        <span class="badge bg-info float-right">{{ params.total }} {{ params.total > 1 ? 'registros' : 'registro' }}</span>
                    </td>
                </tr>
                <slot></slot>
            </tbody>
        </table>
        <div class="row-fluid" v-if="!noFooter">
            <div class="registros">
                Exibir
                <select class="custom-select" v-model="params.per_page" @change="fetchData">
                    <option>15</option>
                    <option>30</option>
                    <option>45</option>
                </select>
                registros
            </div>
            <div class="pagina">
                Página
                <input type="text" v-model="params.current_page" @keyup.enter="fetchData" class="form-control">
                de {{ params.last_page }}
            </div>
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="#" @click.prevent="prev">«</a></li>
                <li class="page-item"><a class="page-link" href="#" @click.prevent="next">»</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { watch,onMounted } from 'vue'

    export default {
        name: 'DataGrid',
        props: {
            thead: {
                required: true,
                type: Array
            },
            params: {
                type: Object
            },
            noWrap: {
                type: Boolean,
                default: true
            },
            noFooter: {
                type: Boolean,
                default: false
            },
            noParams: {
                type: Boolean,
                default: false
            },
            noPaginate: {
                type: Boolean,
                default: false
            }
        },
        setup(props, { emit }) {

            const sort = (column) => {
                if(column === props.params.column) {
                    props.params.direction = props.params.direction === 'desc' ? 'asc' : 'desc'
                } else {
                    props.params.column = column
                    props.params.direction = 'asc'
                }

                fetchData()
            }

            const next = () => {
                if(props.params.next_page_url) {
                    props.params.current_page++
                    fetchData()
                }
            }

            const prev = () => {
                if(props.params.prev_page_url) {
                    props.params.current_page--
                    fetchData()
                }
            }

            const sortClass = (item) => {
                if(item.sortable && props.params.column !== item.column) {
                    return 'sorting'
                } else if (props.params.column === item.column && props.params.direction === 'asc') {
                    return 'sort-asc'
                } else {
                    return 'sort-desc'
                }
            }

            const fetchData = () => {
                if(props.params.current_page > props.params.last_page) {
                    props.params.current_page = props.params.last_page
                }

                emit('loadData')
            }
            if (props.noPaginate) {
                onMounted(() => {
                    fetchData()
                })
            }
            
            watch(() => props.params.last_page, (v) => {
                if(props.params.current_page > v) {
                    props.params.current_page = v
                    emit('loadData')
                }
            })
            

            return { sort, next, prev, sortClass, fetchData }
        }
    }
</script>
