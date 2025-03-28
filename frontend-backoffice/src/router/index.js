import { createRouter, createWebHistory } from 'vue-router';

import LoginAdmin from '../components/Auth/LoginAdmin.vue';
import Dashboard from '../components/Panel/Dashboard.vue';
import Transactions from '../components/Transaction/Transactions.vue';
import userOperations from '../components/User/userOperations.vue';


const routes = [
  { 
    path: '/', 
    name: 'login', 
    component: LoginAdmin 
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }, 
    children: [
      {
        path: 'transactions', 
        name: 'transactions',
        component: Transactions,
        meta: { requiresAuth: true },
      },
      {
        path: 'user_operations', 
        name: 'user_operations',
        component: userOperations,
        meta: { requiresAuth: true },
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Route Guard
router.beforeEach((to, from, next) => {
  const idAdmin = localStorage.getItem('id_admin');

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!idAdmin) {
      next('/');
    } else {
      next();
    }
  } else if (to.name === 'login' && idAdmin) {
    next('/dashboard'); 
  } else {
    next();
  }
});

export default router;