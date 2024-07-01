import axios from 'axios';
import { getCookie } from './functions';
const token = getCookie('Token');

export const api = axios.create({
    baseURL: 'https://van191024.xyz/api/',
    headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});
