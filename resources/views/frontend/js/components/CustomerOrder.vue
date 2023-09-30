<template>
    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Order Id</td>
                <td>Product</td>
                <td>Order At</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!this.loading && (this.orders.length > 0)" v-for="(order, index) in this.orders" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ order.id }}</td>
                <td>{{ order.name }}</td>
                <td>{{ formatDate(order.created_at) }}</td>
                <td>
                    <span class="badge bg-primary" v-if="order.status == 1">Completed</span>
                    <span class="badge bg-warning" v-if="order.status == 2">Cancelled</span>
                </td>
                <td>
                    <a href="#" v-if="order.status == 1" class="btn btn-sm btn-danger" @click="cancelOrder(order)">Cancel</a>
                    <span class="badge bg-danger" v-if="order.status !== 1">Action Not Available</span>
                </td>
            </tr>
            <tr  v-if="!this.loading && (this.orders.length <= 0)">
                <td colspan="6">
                    <center>No Record Found</center>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

    export default{
        data(){
            return{
                orders:[],
                loading:true,
            }
        },
        mounted(){
            this.fetchOrders();
        },
        methods:{
            async fetchOrders(){
                this.loading = true;
                await axios.get('get-orders')
                .then((response)=>{
                    this.orders = response.data.data;
                }).catch((error)=>{

                }).finally(()=>{
                    this.loading = false;
                })
            },
            formatDate(timestampString){
                const timestamp = new Date(timestampString);
                const formattedDate = timestamp.toLocaleDateString(); // Format: MM/DD/YYYY
                const formattedTime = timestamp.toLocaleTimeString(); // Format: HH:MM:SS
                return formattedDate+', '+formattedTime;
            },
            async cancelOrder(order){
                if(confirm("Are You Sure Want To Cancel This Order")){
                    await axios.post('cancel-order', {
                        order_id:order.id
                    }).then((response)=>{
                        toast.success(response.data.message, {
                            autoClose: 1000,
                        });
                        this.fetchOrders();
                    }).catch((error)=>{
                        toast.success(response.data.message, {
                            autoClose: 1000,
                        });
                    })
                }
            }
        }
    }
</script>