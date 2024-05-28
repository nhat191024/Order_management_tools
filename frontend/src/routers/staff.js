const staff = [
    {
        path: "/",
        component: () => import("../layouts/staff.vue"),
        children: [
            {
                path: "/",
                name: "staff",
                component: () => import("../pages/staffs/index.vue"),
            }
        ]
    }
]


export default staff;