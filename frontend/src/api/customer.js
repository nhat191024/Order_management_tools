import { api } from "./api";

export async function getMenuData() {
  return await api.get(`/menu`).then((res) => {
    return res.data.data;
  });
}

export async function addOrderItems(table_id, branch_id, ...dishes) {
  return await api.post(`/orderConfirm`, {
    table_id: table_id,
    branch_id: branch_id,
    dishes: dishes
  }).then((res) => {
    return res;
  });
}

export async function getBranches(tableId) {
  return await api.get(`/tableBranch/${tableId}`).then((res) => {
    return res;
  });
}