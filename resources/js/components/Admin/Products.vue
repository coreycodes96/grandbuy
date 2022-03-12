<template>
  <div class="mt-24">
      <!-- Loader -->
      <div v-if="loading" class="fixed top-0 left-0 flex justify-center items-center w-full h-screen z-20">
          <div class="p-3 bg-yellow-500 rounded text-white">
              <i class="fas fa-spinner animate-spin text-3xl"></i>
          </div>
      </div>

      <!-- Create A Product -->
      <CreateProduct />

      <!-- No Products -->
      <template v-if="!loading && fetchProducts.length === 0">
          <div class="flex justify-center items-center w-full h-500 text-indigo-800 select-none">
              <p class="sm:text-2xl text-xl">There are currently no products!</p>
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
                    </div>

                    <!-- Buttons -->
                    <div class="mt-5">
                        <button @click="deleteTheProduct(product.id)" class="p-2 bg-red-500 text-white rounded">Delete Product</button>
                    </div>
                </div>
            </div>
        </template>
  </div>
</template>

<script>
import CreateProduct from './CreateProduct.vue';
import {mapActions, mapGetters} from 'vuex';

export default {
  components: {
    'CreateProduct': CreateProduct,
  },
  data(){
    return {
      loading: false
    }
  },
  methods: {
    ...mapActions('admin', ['getProducts', 'deleteProduct']),
    deleteTheProduct(id){
      this.deleteProduct(id)
      .then(() => {
        this.getProducts();
      })
      .catch(error => {
        console.log(error.response);
      })
    },
  },
  computed: {
    ...mapGetters('admin', ['fetchProducts']),
  },
  created(){
    this.loading = true;

    this.getProducts()
    .then(() => {
      this.loading = false;
    })
    .catch(error => {
      console.log(error.response);
      this.loading = false;
    })
  }
}
</script>