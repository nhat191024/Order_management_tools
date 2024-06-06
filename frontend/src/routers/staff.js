const staff = [
  {
    path: "/",
    component: () => import("../layouts/staff.vue"),
    children: [
      {
        path: "/",
        component: () => import("../layouts/staff.vue"),
        children: [
            {
                path: "/staff/login",
                name: "staff_login",
                component: () => import("../pages/staffs/index.vue"),
            },
            {
                path: "/kitchen/selectTable",
                name: "kitchen_select_Table",
                component: () => import("../pages/staffs/selectTable.vue"),
            },
            {
                path: "/kitchen/selectKitchen",
                name: "kitchen_select_kitchen",
                component: () => import("../pages/staffs/selectKitchen.vue"),
            },
        ]
    }
    
]
export default staff;