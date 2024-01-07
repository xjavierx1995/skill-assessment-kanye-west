// src/router/index.js
import { RouteRecordRaw, createRouter, createWebHistory } from 'vue-router';
import MainIndex from '../layouts/main/index.vue';
import AuthIndex from '../layouts/auth/index.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    component: MainIndex,
    children: [
      {
        path: '/',
        name: 'Home',
        component: () => import("../views/Home.vue"),
        meta: {
          requiresAuth: true
        },
      },
    ]
  },
  {
    path: '/auth',
    component: AuthIndex,
    children: [
      {
        path: '/login',
        name: 'Login',
        component: () => import("../views/auth/Login.vue"),
      },
    ]
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (false) {//TODO: validate if user is authenticated
      next();
    } else {
      next({ name: "Login" });
    }
  } else {
    next();
  }
});
export default router;
