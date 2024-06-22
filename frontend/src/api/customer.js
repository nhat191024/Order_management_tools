import { api } from "./api";

export async function getMenuData() {
  return await api.get(`/menu`).then((res) => {
    return res.data.data;
  });
}
