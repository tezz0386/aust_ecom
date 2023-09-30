<template>
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search"
                        @click="this.show_search = !this.show_search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="panel-search w-full p-t-10 p-b-15" :class="{ 'dis-none': !this.show_search }">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                            placeholder="Search" v-model="search_query" @keyup.enter="fetchProduct()">
                    </div>
                </div>

            </div>
            <div class="row isotope-grid" v-if="!this.loading && (this.products.length > 0)">
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women" v-for="(product, index) in this.products"
                    :key="index">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img :src="product.image" alt="IMG-PRODUCT">
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ product.name }}
                                </a>

                                <span class="stext-105 cl3">
                                    A$ {{ product.price_of_unit }}
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 btn-primary btn-sm dis-block pos-relative"
                                    @click="setSingleProduct($event, product)">
                                    Purchase
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row isotope-grid" v-if="!this.loading && (this.products.length <= 0)">
                <div style="text-align: center;">
                    No Record Found
                </div>
            </div>
        </div>
    </div>



    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" :class="{ 'show-modal1': this.single_product }"
        v-if="this.single_product">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/asset/images/icons/icon-close.png" alt="CLOSE" @click="this.single_product = null">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img :src="this.single_product.image" alt="IMG-PRODUCT">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{ this.single_product.nam }}
                            </h4>

                            <span class="mtext-106 cl2">
                                A$ {{ this.single_product.price_of_unit }}
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                {{ this.single_product.summary }}
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                                @click="this.decreaseQty()">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" v-model="this.purchanse_item.qty" :min="1"
                                                :max="this.single_product.stock_qty">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                                @click="increaseQty()">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                            <br>
                                            <span class="text-danger" v-if="this.errors['qty']">{{ this.errors['qty'][0] }}</span>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                            @click="purchaseItem()">
                                            Purchase
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal1 -->
    <div class="wrap-modal1 wrap-modal5 js-modal1 p-t-60 p-b-20" :class="{ 'show-modal1': this.show_card_check }"
        v-if="this.single_product">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/asset/images/icons/icon-close.png" alt="CLOSE" @click="this.show_card_check = false">
                </button>
                <div class="row">
                    <div class="container">
                        <div class="col-md-12 col-lg-12 p-b-30">
                            <div class="form-group">
                                <label for="">Card Number</label>
                                <input type="number" name="card_number" class="form-control" v-model="this.purchanse_item.card_number">
                                <span class="text-danger" v-if="this.errors['card_number']">{{ this.errors['card_number'][0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">Pin</label>
                                <input type="number" name="card_number" class="form-control" v-model="this.purchanse_item.pin">
                                <span class="text-danger" v-if="this.errors['pin']">{{ this.errors['pin'][0] }}</span>
                            </div>
                            <button class="btn btn-primary btn-lg float-right" @click="submitPurchase()">Submit</button>
                        </div>
                    </div>
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
    props: {
        is_auth: {
            type: Number,
            required: false,
            default: 0,
        },
    },
    data() {
        return {
            show_search: false,
            search_query: null,
            products: [],
            loading: true,
            single_product: null,
            show_card_check: false,
            load_purchase: false,
            errors:[],
            purchanse_item: {
                product: this.single_product,
                qty: 1,
                card_number:null,
                pin:null,
            }
        }
    },
    mounted() {
        this.fetchProduct();
    },
    methods: {
        setSingleProduct(event, product) {
            if(this.is_auth === 0){
                window.location.href = '/login';
                return;
            }
            event.preventDefault();
            this.single_product = product;
            this.purchanse_item.product = this.single_product;
        },
        increaseQty() {
            if (this.single_product.stock_qty <= this.purchanse_item.qty) {
                return;
            }
            this.purchanse_item.qty++;
        },
        decreaseQty() {
            if (this.purchanse_item.qty <= 1) {
                return;
            }
            this.purchanse_item.qty--;
        },
        async fetchProduct() {
            try {
                const response1 = await axios.get('get-products', {
                    params: {
                        search_query: this.search_query,
                    },
                });

                const response2 = await axios.get(`${window.next_url}/get-products`, {
                    params: {
                        search_query: this.search_query,
                    },
                });

                // Merge the data from both responses
                this.products = [...response1.data.data, ...response2.data.data];
            } catch (error) {
                console.error("An error occurred:", error);
            } finally {
                this.loading = false;
            }
        },
        async purchaseItem() {
            this.show_card_check = true;
        },
        async submitPurchase(){
            this.load_purchase = true;
            await axios.post('purchase-item', {
                ...this.purchanse_item,
            }).then((response) => {
                toast.success(response.data.message, {
                    autoClose: 1000,
                });
                setTimeout(() => {
                    window.location.href = '/dashboard';
                    return;
                }, 100);
                this.single_product = null;
                this.show_card_check= false;
            }).catch((error) => {
                toast.error(error.response.data.message, {
                    autoClose: 1000,
                });
                if(error.response.status == 422){
                    this.errors = error.response.data.data;
                }
            }).finally(() => {
                this.load_purchase = false;
            })
        }
    }
}
</script>


<style scoped>
.wrap-modal5 {
    width: 50%;
    left: 25%;
    top: 100px;
}
</style>