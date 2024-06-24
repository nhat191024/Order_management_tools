const customer = [
    {
        path: "/order/:id",
        name: "order",
        component: () => import("../pages/customers/index.vue"),
    },
    {
        path: "/orderConfirm/:id",
        name: "orderConfirm",
        component: () => import("../pages/customers/orderConfirm.vue"),
    }
]


export default customer;