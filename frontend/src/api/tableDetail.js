import { api } from './api';

export async function getMenu() {
    return await api.get(`/staff/menu`).then((res) => {
        return res.data.data;
    });
}

export async function getTableCurrentBill(id) {
    return api.get(`/staff/currentOrder/${id}`).then((res) => {
        return res.data.data[0].Table_bill;
    });
}

export async function addOrderItems(table_id, user_id, ...dishes) {
    return await api.post(`/staff/order`, {
        table_id: table_id,
        user_id: user_id,
        dishes: dishes
    }).then((res) => {
        return res.data.data;
    });
} 