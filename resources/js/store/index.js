import Vue from 'vue';
import Vuex from 'vuex';

import account from './modules/account.js';
import products from './modules/products.js';
import orders from './modules/orders.js';
import admin from './modules/admin.js';
import notification from './modules/notifications.js';

Vue.use(Vuex);

export default new Vuex.Store({
	modules:{
		account,
		products,
		orders,
		admin,
		notification,
	}
});