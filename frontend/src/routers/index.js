import { createRouter, createWebHistory } from 'vue-router';
import customer from './customer';
import staff from './staff';
import admin from './admin';
const routes = [...customer, ...staff, ...admin];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;