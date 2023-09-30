<template>
    <div class="container" style="margin-bottom: 250px;">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group custom-sidebar">
                    <li class="list-group-item" @click="this.tab_index = 1">
                        <a href="#" class="d-block custom-link" @click="this.tab_index = 1">Dashboard</a>
                    </li>
                    <li class="list-group-item" @click="this.tab_index = 2">
                        <a href="#" class="d-block custom-link" @click="this.tab_index = 2">Check Card</a>
                    </li>
                    <li class="list-group-item" @click="this.tab_index = 3">
                        <a href="#" class="d-block custom-link" @click="this.tab_index = 3">Add Balance</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 custom-content">
                <div v-if="this.tab_index==1">
                    <customer-order></customer-order>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import CustomerOrder from './CustomerOrder.vue';
export default {
    components:{
        CustomerOrder,
    },
    props: {
        is_auth: {
            type: Number,
            required: false,
            default: 0,
        },
    },
    data(){
        return{
            tab_index:1,
        }
    }
}
</script>