const staff = [
    {
        path: "/",
        component: () => import("../layouts/staff.vue"),
        children: [
            {
                path: "/staff",
                name: "staff",
                component: () => import("../pages/staffs/index.vue"),
            },
            {
                path: "/staff_2",
                name: "staff fast login",
                component: () => import("../pages/staffs/index_fast_login.vue"),
            },
            {
                path: "/selectTable",
                name: "selectTable",
                component: () => import("../pages/staffs/selectTable.vue"),
            }
        ]
    }
]


export default staff;