<script setup>
import Bill from "./../../components/staffs/bill.vue";

const billData = {

    // Thông tin phụ của hoá đơn
    tableName: "Bàn 1",
    areaName: "Khu 1",
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
    ]
};
</script>

<template>
    <div class="grid grid-cols-12 grid-rows-12 gap-5 h-screen w-screen">
        <div class="col-span-6 row-span-12 grid">
            <div class="p-4 h-0">
                <button class="items-center bg-white drop-shadow-2x text-black inline-flex">
                    <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                        <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                    </div>
                    <span class="text-xl drop-shadow">Trở về</span>
                </button>
            </div>
            <Bill v-bind:billData="billData" class="row-start-2 ml-16"> </Bill style="z-index: 4;">
            <div class="flex justify-center items-center">
                <button class="btn btn-primary text-white shadow-md w-1/2 ml-16 text-xl">In Hoá Đơn</button>
            </div>
        </div>
        <div class="flex justify-center items-center col-span-6 row-span-12 z-0">
            <div>
                <!-- chỗ này để hiển thị ảnh QR -->
                <img class="w-full" src="./../../assets/qr.png" style="z-index: 0;">

            </div>
        </div>
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