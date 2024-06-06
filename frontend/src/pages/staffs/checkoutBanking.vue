<script setup>
import Bill from "./../../components/staffs/bill.vue";

const billData = {
    // Thông tin phụ của hoá đơn
    tableName: "Bàn 1",
    area: "Khu 1",
    time_join: "01/01/24 16:31",
    time_leave: "01/01/24 18:04",

    // Tính toán tổng tiền...
    total: items => {
        let total = 0
        items.forEach(i => {
            total += i.price * i.quantity;
        })
        return total
    },

    // Danh sách các món đã đặt trên hoá đơn 
    items: [
        {
            name: "Oc xao",
            quantity: 3,
            price: 10000
        },
        {
            name: "Oc nuong",
            quantity: 12,
            price: 14500
        },
        {
            name: "Oc nau",
            quantity: 9,
            price: 10880
        },
    ]
};
</script>

<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <Bill v-bind:billData="billData" class="col-start-2 col-span-10 row-start-2 row-span-3"></Bill>
    </div>
</template>


<script>
export default {
    data() {
        return {
            testVar: 'test',
        }
    },

    methods: {
        test() {
            console.log("test")
        }
    }
}
</script>