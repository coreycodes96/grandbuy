<template>
  <div class="mt-24">
        <!-- Loader -->
        <div v-if="loading" class="fixed top-0 left-0 flex justify-center items-center w-full h-screen z-20">
            <div class="p-3 bg-yellow-500 rounded text-white">
                <i class="fas fa-spinner animate-spin text-3xl"></i>
            </div>
        </div>

        <!-- No Notifications -->
        <template v-if="!loading && fetchNotifications.length === 0">
            <div class="flex justify-center items-center w-full h-500 text-indigo-800 select-none">
                <p class="sm:text-2xl text-xl">You have no notifications</p>
            </div>
        </template>

        <!-- Notifications -->
        <template v-else>
            <div v-for="(notification) in handleNotifications(fetchNotifications)" :key="notification.id">
                <div class="my-20 mx-auto p-3 w-4/5 h-auto bg-yellow-600 text-white sm:rounded rounded-none select-none">
                    <!-- Data -->
                    <div class="w-full h-auto">
                        <h3 class="mb-2 font-semibold">Status: {{notification.data.info.status}}</h3>
                        <img class="object-fit w-full h-96" :src="notification.data.info.product_image" :alt="notification.data.info.product_name" />
                        <p>Product Name: {{notification.data.info.product_name}}</p>
                        <p>Product Amount: X{{notification.data.info.amount}}</p>
                        <p>Price: £{{notification.data.info.amount * notification.data.info.product_price}}</p>
                        <button @click="deleteTheNotification(notification.id)"  class="mt-2 p-2 bg-red-500 text-white rounded">Delete notification</button>
                    </div>
                </div>
            </div>
        </template>
  </div>
</template>

<script>
import {bus} from '../../app';
import {mapActions, mapGetters} from 'vuex';
export default {
    props: {
        userId: {
            type: Number
        }
    },
    data(){
        return {
            loading: false,
        }
    },
    methods: {
        ...mapActions('notification', ['getNotifications', 'deleteNotification']),
        handleNotifications(notifications){
            return notifications.map(data => {
                return {
                    id: data.id,
                    type: data.type,
                    notifiable_type: data.notifiable_type,
                    notifiable_id: data.notifiable_id,
                    data: JSON.parse(data.data),
                    read_at: data.read_at,
                    created_at: data.created_at,
                    updated_at: data.updated_at,
                }
            })
        },
        deleteTheNotification(id){
            this.deleteNotification(id)
            .then(() => {
                this.getNotifications(this.userId);
                bus.$emit('notification_count_takeone');
            })
            .catch(error => console.log(error.response))
        },
    },
    computed: {
        ...mapGetters('notification', ['fetchNotifications']),
    },
    created(){
        this.loading = true;

        this.getNotifications(this.userId)
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