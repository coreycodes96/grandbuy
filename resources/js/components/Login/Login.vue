<template>
  <div class="select-none mt-28 w-full h-500 flex flex-col justify-center items-center bg-yellow-500">
    <form @submit.prevent="login" class="w-full">
        <!-- Email -->
        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
            <input class="pl-2 w-full h-full" name="email" type="text" placeholder="Email" v-model.trim="email" />
            <div v-if="errors.email !== ''">
                <p class="text-red-500">{{errors.email}}</p>
            </div>
        </div>

        <!-- Password -->
        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
            <input class="pl-2 w-full h-full" name="password" type="password" placeholder="Password" v-model.trim="password" />
            <div v-if="errors.password !== ''">
                <p class="text-red-500">{{errors.password}}</p>
            </div>
        </div>

        <!-- Button -->
        <div class="my-10 mx-auto w-4/5 ">
            <button class="p-3 w-48 rounded bg-white">Login <i v-if="loading" class="ml-2 fas fa-spinner animate-spin"></i></button>
        </div>
    </form>
  </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
  data() {
    return {
        email: '',
        password: '',
        errors: {
            email: '',
            password: '',
        },
        loading: false,
    };
  },
  methods:{
      ...mapActions('account', ['logTheUserIn']),
      login(){
        const validEmailOnly = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //email validation
        if(this.email === ''){
            this.errors.email = 'Please enter your email';
        }else if(this.email.length > 255){
            this.errors.email = 'Your email cannot be more than 255 characters';
        }else if(!validEmailOnly.test(this.email)){
            this.errors.email = 'Your email is not valid, please enter a valid one';
        }else{
            this.errors.email = '';
        }

        //password validation
        if(this.password === ''){
            this.errors.password = 'Please enter a password';
        }else if(this.password.length < 8){
            this.errors.password = 'Your password cannot be less than 8 characters';
        }else if(this.password.length > 255){
            this.errors.password = 'Your password cannot be more than 255 characters';
        }else{
            this.errors.password = '';
        }

        if(this.errors.email === '' && this.errors.password === ''){
            this.loading = true;

            const data = {
                email: this.email, 
                password: this.password
            };

            this.logTheUserIn(data)
            .then(res => {
                this.loading = false;

                //User
                if(res.data.admin === 0){
                    location.replace('http://192.168.1.114:8000/products');
                }

                //Admin
                if(res.data.admin === 1){
                    location.replace('http://192.168.1.114:8000/admin/products');
                }
            })
            .catch(error => {
                console.log(error);
                 this.loading = false;
            })
        }
      }
  }
};
</script>