const notifications = {
    namespaced: true,
    state: {
        notifications: []
    },
    getters: {
        fetchNotifications: state => state.notifications
    },
    actions: {
        //Getting notifications
        getNotifications({commit}, id){
            return new Promise((resolve, reject) => {
                axios.get(`http://192.168.1.114:8000/notifications/show/${id}`, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    resolve(res);
                    commit('STORE_NOTIFICATIONS', res.data);
                })
                .catch(e => {
                    reject(e);
                })
            })
        },
        //Delete notification
        deleteNotification(NULL, id){
            return new Promise((resolve, reject) => {
                axios.delete(`http://192.168.1.114:8000/notifications/delete/${id}`, {
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
        addNotification({commit}, id){
            return new Promise((resolve, reject) => {
                axios.get(`http://192.168.1.114:8000/notifications/notification/${id}`, {
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    const notification = {
                        id: res.data.id,
                        type: res.data.type,
                        notifiable_type: res.data.notifiable_type,
                        notifiable_id: res.data.notifiable_id,
                        data: res.data.data,
                        read_at: res.data.read_at,
                        created_at: res.data.created_at,
                        updated_at: res.data.updated_at,
                    };

                    resolve(res);
                    
                    commit('ADD_NOTIFICATION', notification);
                })
                .catch(e => {
                    reject(e);
                })
            })
        }
    },
    mutations: {
        //Storing notifications
        STORE_NOTIFICATIONS(state, data){
            state.notifications = data;
        },
        //Adding a notification
        ADD_NOTIFICATION(state, data){
            state.notifications = [data, ...state.notifications];
        }
    }
};

export default notifications;