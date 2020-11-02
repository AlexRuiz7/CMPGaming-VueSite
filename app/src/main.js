import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import vuetify from './plugins/vuetify';
import VueSocketIO from 'vue-socket.io'
import SocketIO from 'socket.io-client'

// export const SocketInstance = SocketIO('http://127.0.0.1:1942');

Vue.use(new VueSocketIO({
    debug: true,
    connection: SocketIO('http://127.0.0.1:1942'),  
  })
);

Vue.config.productionTip = false

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
