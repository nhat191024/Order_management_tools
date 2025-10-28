import axios from 'axios';
import { getCookie } from './functions';
const token = getCookie('Token');
const apiUrl = import.meta.env.VITE_API_URL;

export const api = axios.create({
    baseURL: apiUrl,
    headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});
