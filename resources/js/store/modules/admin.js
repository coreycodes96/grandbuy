const admin = {
    namespaced: true,
    state: {
        orders: [],
        products: [],
    },
    getters: {
        fetchOrders: state => state.orders,
        fetchProducts: state => state.products,
    },
    actions: {
        //Get orders
        getOrders({commit}, id){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/orders/show/', {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                    commit('STORE_ORDERS', res.data);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Accept order
        acceptOrder(NULL, data){
            return new Promise((resolve, reject) => {
                axios.put('http://192.168.1.114:8000/admin/orders/accept/', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Cancel order
        cancelOrder(NULL, id){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/admin/orders/cancel/${id}`, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Get products
        getProducts({commit}){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/admin/products/show/', {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                    commit('STORE_PRODUCTS', res.data);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Create product
        createProduct(NULL, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/admin/products/create/', data, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Delete product
        deleteProduct(NULL, id){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/admin/products/delete/${id}`, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
    },
    mutations: {
        //Store orders
        STORE_ORDERS(state, data){
            state.orders = data;
        },
        //Store products
        STORE_PRODUCTS(state, data){
            state.products = data;
        }
    }
};

export default admin;