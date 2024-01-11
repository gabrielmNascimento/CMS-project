<template>
    <div class="small-box" :class="bgColor">
        <i 
        v-if="!modal"
        id="doninha-info"
        class="fas fa-info-circle float-right mr-1 mt-1" 
        role="button" 
        :title="info">
        </i>
        <i 
        v-else
        data-toggle = "modal"
        :data-target = "modal"
        id = "doninha-info"
        class = "fas fa-info-circle float-right mr-1 mt-1" 
        role = "button" 
        :title = "info">
        </i>
        <div class="inner">
            <h3>{{value}}</h3>
            <p>{{title}}</p>
        </div>
        <div class="icon">
            <i id="doninha-icon" class="fas" :class="icon"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            required: true
        },
        title: {
            required: true,
            type: String
        },
        icon: {
            required: true,
            type: String
        },
        bgColor: {
            required: true,
            type: String
        },
        info: {
            required: true,
            type: String
        },
        modal: {
            required: false,
            type: String
        }
    }
}
</script>

<style scoped>
#doninha-icon {
    font-size: 60px;
}

#doninha-info {
    font-size: 20px;
    opacity: 0.5;
}

#doninha-info:hover{
    opacity: 1;
}
</style>
