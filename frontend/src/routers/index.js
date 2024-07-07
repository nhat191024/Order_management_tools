import { createRouter, createWebHistory } from 'vue-router';
import customer from './customer';
import staff from './staff';
const routes = [...customer, ...staff];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;