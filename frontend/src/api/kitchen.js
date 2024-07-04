import { api } from "./api";

export async function getKitchenData(branch_id) {
  return await api.get(`/staff/kitchen/${branch_id}`).then((res) => {
    return res.data.kitchens;
  });
}

export async function getKitchenCurrentOrder(branch_id, kitchen_id) {
  return await api.post(`staff/kitchen/order`, {
    branchId: branch_id,
    kitchenId: kitchen_id
  }).then((res) => {
    return res;
  });
}
