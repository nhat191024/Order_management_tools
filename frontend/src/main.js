import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './routers';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js/with-encryption';
import App from './App.vue';
import axios from 'axios';
import './style.css';

window.Pusher = Pusher;
window.axios = axios;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
});

const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.mount('#app');