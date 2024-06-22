import { api } from './api';

export async function getTableData(id) {
    try {
        return await api.get(`staff/tableList/${id}`).then((res) => {
            return res.data.data;
        });
    } catch (error) {
        window.location.reload();
    }
}