import { api } from "./api";

export async function getKitchenData(branch_id) {
  return await api.get(`/staff/kitchen/${branch_id}`).then((res) => {
    return res.data.kitchens;
  });
}
