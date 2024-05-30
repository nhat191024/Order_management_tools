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
                name: "selectTable",
                component: () => import("../pages/staffs/selectTable.vue"),
            }
        ]
    }
]


export default staff;