import { createApp } from 'vue'
import router from './routers'
import './style.css'
import App from './App.vue'

import axios from 'axios';
window.axios = axios;

const app = createApp(App);
app.use(router);
app.mount('#app');