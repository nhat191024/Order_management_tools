import { api } from './api';

export async function getMenu() {
    return await api.get(`/staff/menu`).then((res) => {
        return res.data.data;
    });
}