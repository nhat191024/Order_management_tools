import { api } from './api';

export async function getBillData(id) {
    return await api.get(`/staff/checkout/${id}`).then((res) => {
        return res.data.data;
    });
}

export async function checkout(id, timeOut) {
    return await api.post('/staff/checkout', {
        id: id,
        timeOut: timeOut
    }).then((res) => {
        return res;
    });
}