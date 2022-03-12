<template>
  <div
    class="absolute top-0 left-0 p-5 w-full flex justify-between items-center">
    <div>
      <!-- Title -->
      <h1 class="font-semibold">grandbuy.</h1>
    </div>

    <div class="flex">
      <!-- Products -->
      <li class="mr-5 list-none">
        <a href="/products">Products</a>
      </li>

      <!-- Orders -->
      <li class="mr-5 list-none">
        <a href="/orders">Orders</a>
      </li>

      <!-- Notifications -->
      <li class="mr-5 list-none">
        <a class="relative" href="/notifications">
          <span v-if="notificationCount > 0" class="p-2.5 absolute -top-1 -right-4 w-4 h-4 flex justify-center items-center bg-red-500 rounded-full text-white text-xs">
              <template v-if="notificationCount <= 9">
                {{notificationCount}}
              </template>

              <template v-else>
                9+
              </template>
          </span>
          Notifications
        </a>
      </li>

      <!-- Logout -->
      <li class="list-none">
        <button @click="logout">Logout</button>
      </li>
    </div>
  </div>
</template>

<script>
import {bus} from '../../app';
import {mapActions} from 'vuex';

export default {
  props: {
    userId: {
      type: Number,
    }
  },
  data() {
    return {
      notificationCount: 0,
    };
  },
  methods: {
      ...mapActions('account', ['logTheUserOut']),
      ...mapActions('notification', ['getNotifications', 'addNotification']),
      logout(){
          this.logTheUserOut()
          .then(() => {
              location.replace('http://192.168.1.114:8000/login')
          })
          .catch(error => console.log(error))
      },
  },
  created(){
    this.getNotifications(this.userId)
    .then(res => {
      this.notificationCount = this.notificationCount + res.data.filter(n => n.read_at === null).length;
    })
    .catch(error => console.log(error.response))

    //Websocket connection
    Echo.private(`App.Models.User.${this.userId}`)
        //Notification
        .notification((notification) => {
          this.addNotification(notification.id);
          this.notificationCount = this.notificationCount + 1;
        })

    bus.$on('notification_count_takeone', () => {
      this.notificationCount = this.notificationCount - 1;
    })
  }
};
</script>