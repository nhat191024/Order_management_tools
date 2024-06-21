import { api } from './api';

export async function getBillData(id) {
    return await api.get(`/staff/checkout/${id}`).then((res) => {
        return res.data.data[0];
    });
}