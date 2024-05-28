const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            {
                path: "/",
                name: "admin",
                component: () => import("../pages/admins/index.vue"),
            }
        ]
    }
]


export default admin;