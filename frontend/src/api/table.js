import { api } from './api';

export async function getTableData(id){
    return await api.get(`staff/tableList/${id}`).then((res)=>{
        return res.data.data[0];
    });
}