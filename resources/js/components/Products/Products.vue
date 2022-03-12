<template>
    <div class="mt-24">
        <!-- Loader -->
        <div v-if="loading" class="fixed top-0 left-0 flex justify-center items-center w-full h-screen z-20">
            <div class="p-3 bg-yellow-500 rounded text-white">
                <i class="fas fa-spinner animate-spin text-3xl"></i>
            </div>
        </div>

        <!-- Cart -->
        <Cart :user-id="userId" :cart="cart" :data="data" />

        <!-- No Products -->
        <template v-if="!loading && fetchProducts.length === 0">
            <div class="flex justify-center items-center w-full h-500 text-indigo-800 select-none">
                <p class="sm:text-2xl text-xl">There are no products as of now!</p>
            </div>
        </template>

        <!-- Products -->
        <template v-else>
            <div v-for="(product) in fetchProducts" :key="product.id">
                <div class="my-20 mx-auto p-3 w-4/5 h-auto bg-yellow-600 text-white sm:rounded rounded-none select-none">
                    <!-- Name -->
                    <div class="flex justify-between items-center w-full h-auto">
                        <h3 class="mb-2">{{product.name}}</h3>
                    </div>

                    <!-- Image -->
                    <img class="object-fit w-full h-96" :src="product.image" :alt="product.name" />

                    <!-- Description -->
                    <p class="mb-2 text-base whitespace-pre-line">{{product.description}}</p>

                    <!-- Price -->
                    <div class="flex">
                        <p class="text-base font-semibold whitespace-pre-line">£{{product.price}}</p>
                        <button @click="addToCart(product.id)" class="ml-5 px-2 bg-white text-gray-700 text-base rounded">Add</button>
                        <template v-if="cart.filter(p => p === product.id).length > 0">
                            <p class="ml-5">{{cart.filter(p => p === product.id).length}}</p>
                            <button @click="removeFromCart(product.id)" class="ml-5 px-2 bg-white text-gray-700 text-base rounded">Remove</button>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import Cart from './Cart.vue';
import { mapActions, mapGetters } from 'vuex';
export default {
    props: {
        userId: {
            type: Number
        },
    },
    components: {
        'Cart': Cart,
    },
    data(){
        return {
            data: [],
            cart: [],
            loading: false,
        }
    },
    methods:{
        ...mapActions('products', ['getProducts']),
        addToCart(id){
            if(!this.cart.includes(id)){
                this.cart = [];
            }

            this.cart.push(id);
        },
        removeFromCart(id){
            this.cart.shift(id);
        }
    },
    computed:{
        ...mapGetters('products', ['fetchProducts'])
    },
    created(){
        this.loading = true;

        //Getting the products
        this.getProducts()
        .then(res => {
            this.data = res.data;
            this.loading = false;
        })
        .catch(error => {
            console.log(error);
            this.loading = false;
        })
    }
}
</script>