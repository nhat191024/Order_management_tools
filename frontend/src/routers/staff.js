const staff = [
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
            }
        ]
    }
]


export default staff;