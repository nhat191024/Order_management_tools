import axios from 'axios';
import { getCookie } from './functions';
const token = getCookie('Token');

export const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});
