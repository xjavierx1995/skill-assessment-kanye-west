// src/router/index.js
import { RouteRecordRaw, createRouter, createWebHistory } from 'vue-router';
import MainIndex from '../layouts/main/index.vue';
import AuthIndex from '../layouts/auth/index.vue';
import { userStore } from '../store/user.store'


const routes: Array<RouteRecordRaw> = [
  {
    path: '',
    component: MainIndex,
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: 'home',
        name: 'Home',
        component: () => import("../views/Home.vue"),
      },
      {
        path: 'favorites',
        name: 'Favorites',
        component: () => import("../views/Favorites.vue"),
      },
      {
        path: 'users',
        name: 'Users',
        component: () => import("../views/Users.vue"),
      },
    ]
  },
  {
    path: '/auth',
    component: AuthIndex,
    children: [
      {
        path: 'login',
        name: 'Login',
        component: () => import("../views/auth/Login.vue"),
      },
      {
        path: 'register',
        name: 'Register',
        component: () => import("../views/auth/Register.vue"),
      },
    ]
  },

  {
    path: '/:catchAll(.*)',
    redirect: 'home'
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const store = userStore();

  if (to.matched.some((record) => record.meta.requiresAuth)) {

    if (store.isLogged && store.user?.isAdmin && to.name !== 'Users') {
      next({ path: '/users' });
      return;
    }
    if (store.isLogged) {
      next();
    } else {
      next({ path: '/auth/login' });
    }
  } else {
    if (to.name === 'Login' && store.isLogged) {
      store.user?.isAdmin ? next({ path: '/users' }) : next({ path: '/home' });
      return;
    }

    next();
  }
});
export default router;
