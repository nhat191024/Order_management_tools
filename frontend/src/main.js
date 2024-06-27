import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './routers'
import './style.css'
import App from './App.vue'

import axios from 'axios';
window.axios = axios;

const app = createApp(App);
const pinia = createPinia();

app.use(router, pinia);
app.mount('#app');