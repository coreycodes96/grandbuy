<template>
  <div class="select-none mt-28 w-full h-500 flex flex-col justify-center items-center bg-yellow-500">
    <form @submit.prevent="createTheAccount" class="w-full">
        <!-- Username -->
        <div class="my-10 mx-auto w-4/5 h-12 bg-blue-500">
            <input class="pl-2 w-full h-full" name="username" type="text" placeholder="Username" v-model.trim="username" />
            <div v-if="errors.username !== ''">
                <p class="text-red-500">{{errors.username}}</p>
            </div>
        </div>

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
            <button class="p-3 w-48 rounded bg-white">Create An Account <i v-if="loading" class="ml-2 fas fa-spinner animate-spin"></i></button>
        </div>
    </form>
  </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
  data() {
    return {
        username: '',
        email: '',
        password: '',
        errors: {
            username: '',
            email: '',
            password: '',
        },
        loading: false,
    };
  },
  methods:{
      ...mapActions('account', ['createAnAccount']),
      createTheAccount(){
        const validEmailOnly = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        //username validation
        if(this.username === ''){
            this.errors.username = 'Please enter your username';
        }else if(this.username.length < 3){
            this.errors.username = 'Your username cannot be less than 3 characters';
        }else if(this.username.length > 25){
            this.errors.username = 'Your username cannot be more than 25 characters';
        }else{
            this.errors.username = '';
        }

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

        if(this.errors.username === '' && this.errors.email === '' && this.errors.password === ''){
            this.loading = true;

            const data = {
                username: this.username, 
                email: this.email, 
                password: this.password
            };

            this.createAnAccount(data)
            .then(res => {
                this.loading = false;
                location.replace('http://192.168.1.114:8000/login');
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