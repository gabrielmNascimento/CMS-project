<template>
    <section :class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas mr-1" :class="icon"></i>
                    {{ title }}
                </h3>
                <div class="card-tools">
                    <slot name="tools"></slot>
                    <router-link v-if="url && permission(authorize)" class="btn btn-sm" :class="btn" :to="url">{{ label }}</router-link>
                </div>
            </div>
            <slot name="filter"></slot>
            <div class="card-body">
                <slot></slot>
            </div>
        </div>
    </section>
</template>

<script>
    import { useAuth } from '../../composition/auth'

    export default {
        name: 'Card',
        props: {
            title: {
                type: String,
                required: true
            },
            icon: {
                type: String,
                required: true
            },
            url: {
                type: String,
                default: '',
                required: false
            },
            btn: {
                type: String,
                default: 'btn-secondary',
                required: false
            },
            label: {
                type: String,
                default: '',
                required: false
            },
            authorize: {
                type: String,
                default: '',
                required: false
            },
            col: {
                type: String,
                default: 'col-lg-12',
                required: false
            }
        },
        setup() {
            const { permission } = useAuth()
            return { permission }
        }
    }
</script>
