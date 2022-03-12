<template>
    <div class="w-full h-8 flex justify-end items-center">
        <!-- Cart Button -->
        <button @click="openCartModal" class="relative">
            <span class="p-2.5 absolute -top-2 right-2.5 w-4 h-4 flex justify-center items-center bg-red-500 rounded-full text-white text-xs">
                <template v-if="cart.length <= 9">
                    {{cart.length}}
                </template>

                <template v-else>
                    9+
                </template>
            </span>
            <i class="pr-5 text-xl fas fa-shopping-cart"></i>
        </button>

        <!-- Cart Modal -->
        <div ref="cartModal" class="hidden mr-min-100 fixed top-0 right-0 w-full h-screen z-30 backdrop-blur-sm">
            <div class="absolute top-0 right-0 w-3/5 h-screen bg-white">
                <div class="pt-5 pr-5 w-full flex justify-end items-center">
                    <i @click="closeCartModal" class="cursor-pointer text-2xl fas fa-times text-gray-800"></i>
                </div>

                <!-- Data -->
                <div class="p-5 h-4/5" :class="(cart.length === 0 ? '' : 'overflow-y-scroll')">
                    <!-- No items -->
                    <template v-if="cart.length === 0">
                        <div class="flex justify-center items-center w-full h-screen text-gray-800 select-none">
                            <p class="sm:text-2xl text-xl">Your cart is empty</p>
                        </div>
                    </template>
                    
                    <!-- Items -->
                    <template v-else>
                        <div v-for="(item) in getItems()" :key="item.id">
                            <div class="my-5 p-3 h-auto bg-yellow-600 text-white sm:rounded rounded-none select-none">
                                <!-- Name -->
                                <div class="flex justify-between items-center w-full h-auto">
                                    <h3 class="mb-2">{{item.name}}</h3>
                                </div>

                                <!-- Image -->
                                <img class="object-fit w-full h-96" :src="item.image" :alt="item.name" />

                                <!-- Description -->
                                <p class="mb-2 text-base whitespace-pre-line">{{item.description}}</p>

                                <!-- Price -->
                                <div class="flex">
                                    <p class="text-base font-semibold whitespace-pre-line">£{{item.price}}</p>
                                    <p class="ml-5 font-semibold">Total: £{{+item.price * cart.filter(p => p === item.id).length}}</p>
                                    <button @click="addToCart(item.id)" class="ml-5 px-2 bg-white text-gray-700 text-base rounded">Add</button>
                                    <p class="ml-5">{{cart.filter(p => p === item.id).length}}</p>
                                    <button @click="removeFromCart(item.id)" class="ml-5 px-2 bg-white text-gray-700 text-base rounded">Remove</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Order -->
                <div v-if="cart.length !== 0" class="mx-auto w-4/5 h-12">
                    <button @click="placeOrder" class="mt-5 w-full h-full bg-gray-900 text-white text-center rounded">Place Order <i v-if="loading" class="ml-2 fas fa-spinner animate-spin"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        userId: {
            type: Number,
        },
        cart: {
            type: Array,
        },
        data: {
            type: Array,
        }
    },
    data(){
        return {
            finalItems: [],
            loading: false,
        }
    },
    methods:{
        ...mapActions('orders', ['placeAnOrder']),
        openCartModal(){
            tl.to(this.$refs.cartModal, {display: 'flex', marginRight: '0', duration: 0.3, ease: "power3.out"});
        },
        closeCartModal(){
            tl.to(this.$refs.cartModal, {display: 'hidden', marginRight: '-100%', duration: 0.3, ease: "power3.out"});
        },
        getItems(){
            const cartCopy = this.cart;
            const array = Array.from(new Set(cartCopy));

            const items = this.data.filter(p => array.includes(p.id));

            this.finalItems = items;

            return items;
        },
        addToCart(id){
            this.cart.push(id);
        },
        removeFromCart(id){
            const idx = this.cart.indexOf(id);

            if (idx >= 0) {
                this.cart.splice(idx, 1);
            }
        },
        setOrder(ids){
            const idsCopy = ids;
            const newIds = Array.from(new Set(idsCopy));

            const final = [];
            for(let i = 0; i < newIds.length; i++){
                const data = {
                    item: newIds[i],
                    amount: idsCopy.filter(id => id === newIds[i]).length,
                }

                final.push(data);
            }

            return final;
        },
        placeOrder(){
            const itemsIds = this.cart;

            const data = {
                userId: this.userId,
                items: this.setOrder(itemsIds),
            }

            this.loading = true;

            this.placeAnOrder(data)
            .then(res => {
                this.loading = false;
                this.finalItems = [];
                location.replace('http://192.168.1.114:8000/orders');
            })
            .catch(error => {
                console.log(error.response);
                this.loading = false;
            })
        },
    },
}
</script>