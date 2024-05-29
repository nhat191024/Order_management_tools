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
        path: "/select_kitchen",
        name: "chonBep",
        component: () => import("../pages/staffs/select_kitchen.vue"),
      },
    ],
  },
];

export default staff;
