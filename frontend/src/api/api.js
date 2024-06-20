import axios from 'axios';

// const bearerToken = '1|PyARy0nGVMtmeWflwhQitXYTPrAGcGuffliLhiV00bc1a92e';

console.log(bearerToken);
export const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        Authorization: `Bearer ${bearerToken}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});
