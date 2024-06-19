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
                        Khu: {{ billData.areaName }}
                        <br>Bàn: {{ billData.tableName }}
                    </h1>
                    <h1 class="text-sm">
                        Giờ vào: {{ billData.time_join }}
                        <br>Giờ ra: {{ billData.time_leave }}
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
                            <tr v-for="i in billData.items" :key="i.name">
                                <td>{{ i.name }}</td>
                                <td>{{ i.quantity }}</td>
                                <td>{{ i.price }}</td>
                                <td>{{ i.price * i.quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mx-7 flex justify-between items-center border-t border-black">
                    <h1 class="text-center translate-y-4 text-xl font-semibold">Tổng cộng:</h1>
                    <!-- <h1 class="text-center translate-y-4 text-xl font-semibold">{{ billData.value.total(billData.value.items) }} VND
                    </h1> -->
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
import axios from 'axios';
const route = useRoute();
const id = Number(route.params.id);

// const response = await axios.post('http://127.0.0.1:8000/api/login', {
//     username: 'staff',
//     password: 'staff',
// });

// localStorage.setItem('bearerToken', response.data.data.token);

// console.log(response.data.data.token);

const bearerToken = localStorage.getItem('bearerToken');
console.log(bearerToken);
const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        Authorization: `Bearer ${bearerToken}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

const fetchBill = async () => {
    try {
        const response = await api.get(`staff/billCheckout/${id}`);
        const data = await response.data;
        console.log('Bill data:', data);
        //     "data": [
        //     {
        //         "Bill_id": 1,
        //         "Bill_table": {
        //             "Table_id": 1,
        //             "Table_number": "1",
        //             "Table_status": 1
        //         },
        //         "Bill_total": 0,
        //         "Bill_pay_status": 0,
        //         "Bill_time_in": "2019-11-11 08:00:00",
        //         "Bill_time_out": null,
        //         "Bill_detail": [
        //             {
        //                 "BillDetail_id": 1,
        //                 "BillDetail_quantity": 1,
        //                 "BillDetail_price": "30000",
        //                 "BillDetail_note": null,
        //                 "BillDetail_Dish": {
        //                     "Dish_id": 1,
        //                     "Dish_additional_price": 0,
        //                     "Dish_note": ""
        //                 }
        //             },
        //             {
        //                 "BillDetail_id": 2,
        //                 "BillDetail_quantity": 1,
        //                 "BillDetail_price": "30000",
        //                 "BillDetail_note": null,
        //                 "BillDetail_Dish": {
        //                     "Dish_id": 2,
        //                     "Dish_additional_price": 0,
        //                     "Dish_note": ""
        //                 }
        //             },
        //             {
        //                 "BillDetail_id": 3,
        //                 "BillDetail_quantity": 1,
        //                 "BillDetail_price": "30000",
        //                 "BillDetail_note": null,
        //                 "BillDetail_Dish": {
        //                     "Dish_id": 3,
        //                     "Dish_additional_price": 0,
        //                     "Dish_note": ""
        //                 }
        //             }
        //         ]
        //     }
        // ]
        // billData.tableName = data.data[0].Bill_table.Table_number;
        console.log('Table number:' + data.data[0].Bill_table.Table_number);

        billData.value.items = data.data[0].Bill_detail.map(item => ({

            name: item.BillDetail_Dish.Dish_name,
            quantity: item.BillDetail_quantity,
            price: item.BillDetail_price,
        }));

    } catch (error) {
        console.error('Error fetching bill:', error);
    }
};

const billData = ref({
    tableName: '',
    areaName: '',
    time_join: '',
    time_leave: '',
    total: 0,
    items: []
});

// const billData = [{

// Thông tin phụ của hoá đơn
// tableName: '',
// areaName: "Khu 1",
// time_join: "01/01/24 16:31",
// time_leave: "01/01/24 18:04",

// // Tính toán tổng tiền...
// total: items => {
//     let total = 0
//     items.forEach(i => {
//         total += i.price * i.quantity;
//     })
//     return total
// },

// // Danh sách các món đã đặt trên hoá đơn 
// items: [
//     {
//         name: "Oc xao",
//         quantity: 3,
//         price: 10000
//     },
//     {
//         name: "Oc xao",
//         quantity: 3,
//         price: 10000
//     },
//     {
//         name: "Oc xao",
//         quantity: 3,
//         price: 10000
//     },
// ]
// }];

fetchBill();
</script>