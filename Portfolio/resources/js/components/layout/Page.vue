<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 aqui">
                        <slot name="alert"></slot>
                    </div>
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">{{ title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Page',
        props: {
            title: {
                type: String,
                required: true
            }
        }
    }
</script>
