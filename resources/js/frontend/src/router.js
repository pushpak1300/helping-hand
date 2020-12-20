import Vue from 'vue'
import Router from 'vue-router'
import DashboardLayout from '@/layout/DashboardLayout'
import AuthLayout from '@/layout/AuthLayout'
Vue.use(Router);

const ifAuthenticated = (_to, _from, next) => {
  if (localStorage.getItem('token')!==null) {
    next()
    return
  }
  next('/login');
}

const ifNotAuthenticated = (_to, _from, next) => {
  if (localStorage.getItem('token') === null) {
    next()
    return
  }
  next('/dashboard');
}

export default new Router({
  linkExactActiveClass: 'active',
  mode: 'history',
  routes: [
    {
      path: '/',
      redirect: 'dashboard',
      component: DashboardLayout,
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/Dashboard.vue')
        },
        {
          path: '/profile/:id',
          name: 'profile',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/UserProfile.vue')
        },
        {
          path: '/profile/:id/payment',
          name: 'payment',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/Payment.vue')
        },
        {
          path: '/donate',
          name: 'donate',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/Donate.vue')
        },
        {
          path: '/about-us',
          name: 'about us',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/Payment.vue')
        },
        {
          path: '/generate',
          name: 'generate',
          beforeEnter: ifAuthenticated,
          component: () => import('./views/Generate.vue')
        },
      ]
    },
    {
      path: '/',
      redirect: 'login',
      component: AuthLayout,
      children: [
        {
          path: '/login',
          name: 'login',
          beforeEnter: ifNotAuthenticated,
          component: () => import('./views/Login.vue')
        },
        {
          path: '/register',
          name: 'register',
          component: () => import('./views/Register.vue')
        }
      ]
    }
  ]
})
