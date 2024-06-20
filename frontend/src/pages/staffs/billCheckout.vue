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
            <div class="bg-white rounded-xl drop-shadow-2xl p-5 row-start-2 ml-16">
                <h1 class="font-semibold text-2xl text-center">PHIẾU THANH TOÁN</h1>
                <div class="m-4 flex justify-between items-center ">
                    <h1 class="text-sm">
                        Khu: {{ areaName }}
                        <br>Bàn: {{ tableName }}
                        Khu: {{ areaName }}
                        <br>Bàn: {{ tableName }}
                    </h1>
                    <h1 class="text-sm">
                        Giờ vào: {{ time_in }}
                        <br>Giờ ra: {{ time_leave }}
                        Giờ vào: {{ time_in }}
                        <br>Giờ ra: {{ time_leave }}
                    </h1>
                </div>
                <div class="overflow-scroll min-h-64 max-h-80 border-t border-black">
                    <table class="table overflow-auto">
                        <thead>
                            <tr class="table-row">
                                <th>Tên Món</th>
                                <th>Số lượng</th>
                                <th>Đơn Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="i in items">
                                <td> {{ i.BillDetail_Dish.Dish_food.Food_name + ' ' +
                                    i.BillDetail_Dish.Dish_cooking_method.Cooking_method_name }} </td>
                                <td>{{ i.BillDetail_quantity }}</td>
                                <td> {{ i.BillDetail_Dish.Dish_food.Food_price }} </td>
                                <td>{{ i.BillDetail_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mx-7 flex justify-between items-center border-t border-black">
                    <h1 class="text-center translate-y-4 text-xl font-semibold">Tổng cộng:</h1>
                    <h1 class="text-center translate-y-4 text-xl font-semibold">{{ total }} VND
                    <h1 class="text-center translate-y-4 text-xl font-semibold">{{ total }} VND
                    </h1>
                </div>
            </div>
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

<script setup>
import { ref } from 'vue';
import { useRoute } from "vue-router";
const route = useRoute()
const id = route.params.id;

const areaName = ref("");
const tableName = ref("");
const time_in = ref("");
const time_leave = ref("");
const total = ref("");
const items = ref([]);

// import data from "../../data/bill.json"

import { fetchBill } from '../../api/billCheckout.js';

var data = ref(fetchBill(id));

console.log(data.value.data);



// const [bills] = bill;

// console.log(bills);

// bill.forEach()

// console.log(bill.value);

// data.forEach((item) => {
    // console.log(item);
    // areaName.value = item.Bill_user.User_branch.Branch_name;
    // tableName.value = item.Bill_table.Table_number;
    // time_in.value = item.Bill_time_in;
    // time_leave.value = item.Bill_time_out;
    // total.value = item.Bill_total;
    // // console.log(item);
    // item.Bill_detail.forEach((i) => {
    //     // console.log(i);
    //     items.value.push(i);
    // })
// });







</script>