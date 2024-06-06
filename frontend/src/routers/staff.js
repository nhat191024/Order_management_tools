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
        path: "/show_food_waiting",
        name: "WaitFood",
        component: () => import("../pages/staffs/show_food_waiting.vue"),
      
      },
      
    ],
  },
];

export default staff;
