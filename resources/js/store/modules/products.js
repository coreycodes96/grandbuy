const products = {
    namespaced: true,
    state: {
        products: []
    },
    getters: {
        fetchProducts: state => state.products
    },
    actions: {
        //Getting products
        getProducts({commit}, NULL){
            return new Promise((resolve, reject) => {
                axios.get('http://192.168.1.114:8000/products/show', {
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
    },
    mutations: {
        //Storing products
        STORE_PRODUCTS(state, data){
            state.products = data;
        }
    }
};

export default products;