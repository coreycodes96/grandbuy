const orders = {
    namespaced: true,
    state: {
        orders: []
    },
    getters: {
        fetchOrders: state => state.orders,
    },
    actions: {
        //Get orders
        getOrders({commit}, id){
            return new Promise((resolve, reject) => {
                axios.get(`http://192.168.1.114:8000/orders/show/${id}`, {
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
        //Place order
        placeAnOrder(NULL, data){
            return new Promise((resolve, reject) => {
                axios.post('http://192.168.1.114:8000/orders/create', data, {
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
        }
    }
};

export default orders;