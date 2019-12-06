import Vue from 'vue';
import VueRouter from 'vue-router';

/**
 * Routes Components
 */
import Home     from '../views/Home.vue';
import Profile  from '../views/Profile.vue';
import Servers  from '../views/Servers.vue';
import Stats    from '../views/Stats.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'home',
    component: Home
  },
  {
    path: '/profile',
    name: 'profile',
    component: Profile
  },
  {
    path: '/servers',
    name: 'servers',
    component: Servers
  },
  {
    path: '/stats',
    name: 'stats',
    component: Stats
  },
  { path: '*', redirect: '/home' }
]

const router = new VueRouter({
  routes
})

export default router
