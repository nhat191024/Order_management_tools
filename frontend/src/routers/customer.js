const customer = [
    {
        path: "/",
        component: () => import("../layouts/customer.vue"),
        children: [
            {
                path: "/",
                name: "order",
                component: () => import("../pages/customers/index.vue"),
            }
        ]
    }
]


export default customer;