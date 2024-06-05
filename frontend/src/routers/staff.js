const staff = [
  {
    path: "/",
    component: () => import("../layouts/staff.vue"),
    children: [
      {
        path: "/",
        name: "staff",
        component: () => import("../pages/staffs/index.vue"),
      },
      {
        path: "/selectTable",
        name: "select_table",
        component: () => import("../pages/staffs/selectTable.vue"),
      },
      {
        path: "/selectKitchen",
        name: "select_kitchen",
        component: () => import("../pages/staffs/selectKitchen.vue"),
      },
    ],
  },
];

export default staff;
