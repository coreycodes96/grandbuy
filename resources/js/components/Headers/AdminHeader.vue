<template>
  <div class="absolute top-0 left-0 p-5 w-full flex justify-between items-center">
    <div>
      <!-- Title -->
      <h1 class="font-semibold">grandbuy.</h1>
    </div>
    
    <div class="flex">
        <!-- Products -->
        <li class="mr-5 list-none">
            <a href="/admin/products">Add Product</a>
        </li>
        
        <!-- Orders -->
        <li class="mr-5 list-none">
            <a href="/admin/orders">Orders</a>
        </li>

        <!-- Logout -->
        <li class="list-none">
            <button @click="logout">Logout</button>
        </li>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
  data() {
    return {};
  },
  methods: {
      ...mapActions('account', ['logTheUserOut']),
      logout(){
          this.logTheUserOut()
          .then(() => {
              location.replace('http://192.168.1.114:8000/login')
          })
          .catch(error => console.log(error))
      }
  }
};
</script>