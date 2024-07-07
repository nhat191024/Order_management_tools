import { api } from './api';

export async function getTableData(id) {
    return await api.get(`staff/table/${id}`).then((res) => {
        return res.data.data;
    });
}