const staff = [
  {
    path: "/",
    component: () => import("../layouts/staff.vue"),
    children: [
      {
        path: "/staff/login",
        name: "login",
        component: () => import("../pages/staffs/index.vue"),
      },
      {
        path: "/staff/table",
        name: "table selection",
        component: () => import("../pages/staffs/selectTable.vue"),
      },
      {
        path: "/staff/table/:id",
        name: "table detail",
        component: () => import("../pages/staffs/tableDetail.vue"),
      },
      {
        path: "/kitchen/select",
        name: "kitchen selection",
        component: () => import("../pages/staffs/selectKitchen.vue"),
      },
      {
        path: "/staff/waitingFood",
        name: "waiting food",
        component: () => import("../pages/staffs/showFoodWaiting.vue"),
      },
      {
        path: "/staff/checkout/:id",
        name: "checkout",
        component: () => import("../pages/staffs/checkout.vue"),
      },
    ],
  },
];
export default staff;
