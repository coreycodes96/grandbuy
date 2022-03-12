require('./bootstrap');

import Vue from 'vue';

export const bus = new Vue();

//Headers
Vue.component('guest-header', require('./components/Headers/GuestHeader.vue').default);
Vue.component('user-header', require('./components/Headers/UserHeader.vue').default);
Vue.component('admin-header', require('./components/Headers/AdminHeader.vue').default);

//Create An Account
Vue.component('create-an-account', require('./components/CreateAnAccount/CreateAnAccount.vue').default);

//Login
Vue.component('login', require('./components/Login/Login.vue').default);

//Products
Vue.component('products', require('./components/Products/Products.vue').default);

//Orders
Vue.component('orders', require('./components/Orders/Orders.vue').default);

//Notifications
Vue.component('notifications', require('./components/Notifications/Notifications.vue').default);

//Admin
Vue.component('handle-orders', require('./components/Admin/HandleOrders.vue').default);
Vue.component('handle-products', require('./components/Admin/Products.vue').default);

import store from './store/index';

const app = new Vue({
    el: '#app',
    store,
});
