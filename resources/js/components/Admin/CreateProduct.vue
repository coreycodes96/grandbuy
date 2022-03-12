<template>
    <div>
        <!-- Create Product Button -->
        <div @click="openCreateProductModal" class="w-full flex justify-center items-center">
            <button class="p-2 w-4/5 bg-gray-800 text-white rounded">Create Product</button>
        </div>

        <!-- Modal -->
        <div ref="createProductModal" class="hidden ml-min-100 fixed top-0 left-0 w-full h-screen z-30 bg-yellow-500">
            <div class="w-full">
                <div class="absolute top-5 right-5">
                    <i @click="closeCreateProductModal" class="cursor-pointer text-2xl fas fa-times text-gray-800"></i>
                </div>

                <!-- Data -->
                <div class="mt-40 w-full">
                    <form @submit.prevent="createTheProduct" class="w-full">
                        <!-- Name -->
                        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
                            <input class="pl-2 w-full h-full" name="name" type="text" placeholder="Name" v-model.trim="name" />
                            <div v-if="errors.name !== ''">
                                <p class="text-red-500">{{errors.name}}</p>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
                            <input class="pl-2 w-full h-full" name="image" type="text" placeholder="Image" v-model.trim="image" />
                            <div v-if="errors.image !== ''">
                                <p class="text-red-500">{{errors.image}}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
                            <input class="pl-2 w-full h-full" name="description" type="text" placeholder="Description" v-model.trim="description" />
                            <div v-if="errors.description !== ''">
                                <p class="text-red-500">{{errors.description}}</p>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
                            <input class="pl-2 w-full h-full" name="price" type="text" placeholder="Price" v-model.trim="price" />
                            <div v-if="errors.price !== ''">
                                <p class="text-red-500">{{errors.price}}</p>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="my-10 mx-auto w-4/5 ">
                            <button class="p-3 w-48 rounded bg-white">Create Product <i v-if="loading" class="ml-2 fas fa-spinner animate-spin"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return {
            name: '',
            image: '',
            description: '',
            price: '',
            errors: {
                name: '',
                image: '',
                description: '',
                price: '',  
            },
            loading: false,
        }
    },
    methods: {
        ...mapActions('admin', ['getProducts', 'createProduct']),
        openCreateProductModal(){
            tl.to(this.$refs.createProductModal, {display: 'flex', marginLeft: '0', duration: 0.3, ease: "power3.out"});
        },
        closeCreateProductModal(){
            tl.to(this.$refs.createProductModal, {display: 'hidden', marginLeft: '-100%', duration: 0.3, ease: "power3.out"});
        },
        createTheProduct(){
            //Name validation
            if(this.name === ''){
                this.errors.name = 'Please enter a name';
            }else{
                this.errors.name = '';
            }

            //Image validation
            if(this.image === ''){
                this.errors.image = 'Please enter an image';
            }else{
                this.errors.image = '';
            }

            //Description validation
            if(this.description === ''){
                this.errors.description = 'Please enter an description';
            }else{
                this.errors.description = '';
            }

            //Price validation
            if(this.price === ''){
                this.errors.price = 'Please enter an price';
            }else{
                this.errors.price = '';
            }

            if(this.errors.name === '' && this.errors.image === '' && this.errors.description === '' && this.errors.price === ''){
                this.loading = true;

                const data = {
                    name: this.name,
                    image: this.image,
                    description: this.description,
                    price: this.price,
                };

                this.createProduct(data)
                .then(() => {
                    this.loading = false;
                    this.getProducts();
                    tl.to(this.$refs.createProductModal, {display: 'hidden', marginLeft: '-100%', duration: 0.3, ease: "power3.out"});
                })
                .catch(error => {
                    console.log(error.response);
                    this.loading = false;
                })
            }
        }
    }
}
</script>