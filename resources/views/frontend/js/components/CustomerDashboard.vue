<template>
    <div class="container">
        <div class="row" style="margin-bottom: 25px;">
            <div class="col-md-4">
                <ul class="list-group custom-sidebar">
                    <li class="list-group-item" @click="this.tab_index = 1" :class="{'active-custom-link' : this.tab_index == 1}">
                        <a href="#" class="d-block custom-link" @click="setActive($event, 1)">Dashboard</a>
                    </li>
                    <li class="list-group-item" @click="this.tab_index = 2" :class="{'active-custom-link' : this.tab_index == 2}">
                        <a href="#" class="d-block custom-link" @click="setActive($event, 2)">Check Card</a>
                    </li>
                    <li class="list-group-item" @click="this.tab_index = 3" :class="{'active-custom-link' : this.tab_index == 3}">
                        <a href="#" class="d-block custom-link" @click="setActive($event, 3)">Add Balance</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <div v-if="this.tab_index==1">
                    <customer-order></customer-order>
                </div>
                <div v-if="this.tab_index==2">
                    <customer-card-check></customer-card-check>
                </div>
                <div v-if="this.tab_index==3">
                    <add-balance></add-balance>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import CustomerOrder from './CustomerOrder.vue';
import CustomerCardCheck from './CustomerCardCheck.vue';
import AddBalance from './AddBalance.vue';
export default {
    components:{
        CustomerOrder,
        CustomerCardCheck,
        AddBalance,
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
    },
    setActive(event, i){
        event.preventDefault();
        this.tab_index = i;
    }
}
</script>