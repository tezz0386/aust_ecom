<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Card Check
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
                    <button class="btn btn-primary btn-lg float-right" @click="checkCard()">Submit</button>
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
            card_number: null,
            pin: null,
            errors: [],
            loading: true,
        }
    },
    methods: {
        async checkCard() {
            this.loading = true,
                await axios.post('check-card', {
                    pin: this.pin,
                    card_number: this.card_number,
                }).then((response) => {
                    toast.success(response.data.message, {
                        autoClose: 1000,
                    });
                }).catch((error) => {
                    toast.error(error.response.data.message, {
                        autoClose: 1000,
                    });
                }).finally(() => {
                    this.loading = false;
                })
        }
    }
}
</script>