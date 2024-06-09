const customer = [
    {
        path: "/",
        component: () => import("../layouts/customer.vue"),
        children: [
            {
                path: "/",
                name: "order",
                component: () => import("../pages/customers/index.vue"),
            },
        ]
    },
    {
        path: "/payment",
        name: "payment",
        component: () => import("../pages/customers/pay.vue"),
    }
]

// {
//     path: "/payment",
//     name: "payment",
//     component: () => import("../pages/customers/payment.vue"),
// }
export default customer;