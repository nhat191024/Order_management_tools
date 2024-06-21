import { api } from './api';

export async function getMenu() {
    return await api.get(`/staff/menu`).then((res) => {
        return res.data.data;
    });
}

export async function getTableCurrentBill() {
    return await api.get(`/staff/currentOrder`).then((res) => {
        return res.data.data;
    });
}