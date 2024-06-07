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
                        name: "login",
                        component: () => import("../pages/staffs/index.vue"),
                    },
                    {
                        path: "/staff/table",
                        name: "table selection",
                        component: () => import("../pages/staffs/selectTable.vue"),
                    },
                    {
                        path: "/kitchen/select",
                        name: "kitchen selection",
                        component: () => import("../pages/staffs/selectKitchen.vue"),
                    },
                ]
            }
        ]
    }
]
export default staff;