<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" v-if="this.card">
                    Add Balance Your Balance A$ {{ this.card.balance }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Card Number</label>
                        <input type="number" name="card_number" class="form-control" v-model="this.card_number">
                        <span class="text-danger" v-if="this.errors['card_number']">{{ this.errors['card_number'][0]
                        }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Pin</label>
                        <input type="number" name="card_number" class="form-control" v-model="this.pin">
                        <span class="text-danger" v-if="this.errors['pin']">{{ this.errors['pin'][0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Balance</label>
                        <input type="number" name="card_number" class="form-control" v-model="this.balance">
                        <span class="text-danger" v-if="this.errors['balance']">{{ this.errors['balance'][0] }}</span>
                    </div>
                    <button class="btn btn-primary btn-lg float-right" @click="addBalance()">Add Balance</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    data() {
        return {
            card:null,
            card_number: null,
            pin: null,
            balance:null,
            errors: [],
            loading: true,
        }
    },
    mounted(){
        this.fetchCard();
    },
    methods: {
        async addBalance() {
                await axios.post('get-card', {
                    pin: this.pin,
                    card_number: this.card_number,
                    balance:this.balance,
                }).then((response) => {
                    toast.success(response.data.message, {
                        autoClose: 1000,
                    });
                    this.fetchCard();
                    this.card_number = null;
                    this.pin = null;
                    this.balance = null;
                }).catch((error) => {
                    toast.error(error.response.data.message, {
                        autoClose: 1000,
                    });
                }).finally(() => {
                    
                })
        },
        async fetchCard(){
            await axios.get('get-card')
            .then((response)=>{
                this.card = response.data.data;
            }).catch((error)=>{
                toast.error(error.response.data.message, {
                    autoClose: 1000,
                });
            }).finally(()=>{
                this.loading = false;
            })
        }
    }
}
</script>