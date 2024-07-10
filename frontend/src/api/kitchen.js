import { api } from "./api";

export async function getKitchenData(branch_id) {
  return await api.get(`/kitchen/${branch_id}`).then((res) => {
    return res.data.kitchens;
  });
}

export async function getKitchenCurrentOrder(branch_id, kitchen_id) {
  return await api.post(`/kitchen/order`, {
    branchId: branch_id,
    kitchenId: kitchen_id
  }).then((res) => {
    return res.data;
  });
}

export async function updateOrderStatus(order_id) {
  return await api.get(`/kitchen/orderComplete/${order_id}`).then((res) => {
    return res.data;
  });
}

export async function orderDelete(order_id) {
  return await api.get(`/kitchen/orderDelete/${order_id}`).then((res) => {
    return res.data;
  });

}

export async function getKitchenName(kitchen_id) {
  return await api.get(`/kitchen/name/${kitchen_id}`).then((res) => {
    return res.data;
  });
}