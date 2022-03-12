<template>
    <div class="mt-24">
        <!-- Loader -->
        <div v-if="loading" class="fixed top-0 left-0 flex justify-center items-center w-full h-screen z-20">
            <div class="p-3 bg-yellow-500 rounded text-white">
                <i class="fas fa-spinner animate-spin text-3xl"></i>
            </div>
        </div>

        <!-- No Orders -->
        <template v-if="!loading && fetchOrders.length === 0">
            <div class="flex justify-center items-center w-full h-500 text-indigo-800 select-none">
                <p class="sm:text-2xl text-xl">You have no orders as of now!</p>
            </div>
        </template>

        <!-- Orders -->
        <template v-else>
            <div v-for="(order) in fetchOrders" :key="order.id">
                <div class="my-20 mx-auto p-3 w-4/5 h-auto bg-yellow-600 text-white sm:rounded rounded-none select-none">
                    <!-- Name -->
                    <div class="flex justify-between items-center w-full h-auto">
                        <h3 class="mb-2">{{order.products.description}}</h3>
                    </div>

                    <!-- Image -->
                    <img class="object-fit w-full h-96" :src="order.products.image" :alt="order.products.name" />

                    <!-- Description -->
                    <p class="mb-2 text-base whitespace-pre-line">{{order.products.description}}</p>

                    <!-- Price -->
                    <div class="flex">
                        <p class="text-base font-semibold whitespace-pre-line">£{{order.products.price * order.amount}}</p>
                        <p class="ml-5 font-semibold">Ordered: X{{order.amount}} </p>
                        <p v-if="+order.status === 0" class="ml-5 font-semibold">Status: not out for delivery</p>
                        <p v-if="+order.status === 1" class="ml-5 font-semibold">Status: out for delivery</p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    props: {
        userId: {
            type: Number,
        }
    },
    data(){
        return {
            loading: false,
        }
    },
    methods:{
        ...mapActions('orders', ['getOrders'])
    },
    computed:{
        ...mapGetters('orders', ['fetchOrders'])
    },
    created(){
        this.loading = true;

        //Getting the products
        this.getOrders(this.userId)
        .then(() => {
            this.loading = false;
        })
        .catch(error => {
            console.log(error);
            this.loading = false;
        })
    }
}
</script>