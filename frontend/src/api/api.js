import axios from 'axios';

// const bearerToken = '1|GCIMjkZDfpH8K95NvRV5qervTAAuIxjmgr14icnt51cc86c6';

console.log(bearerToken);
const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        Authorization: `Bearer ${bearerToken}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});
