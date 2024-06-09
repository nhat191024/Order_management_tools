const customer = [
    {
        path: "/order/:id",
        name: "order",
        component: () => import("../pages/customers/index.vue"),
    },
    {
        path: "/payment",
        name: "payment",
        component: () => import("../pages/customers/pay.vue"),
    }
]


export default customer;