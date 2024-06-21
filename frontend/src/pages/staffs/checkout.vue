<template>
    <div class="grid grid-cols-12 grid-rows-12 gap-5 h-screen w-screen">
        <div class="col-span-6 row-span-12 grid z-10">
            <div class="p-4 h-0">
                <RouterLink class="items-center bg-white drop-shadow-2x text-black inline-flex" :to="`/staff/table/${id}`">
                    <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                        <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                    </div>
                    <span class="text-xl drop-shadow">Trở về</span>
                </RouterLink>
            </div>
            <div class="bg-white rounded-xl drop-shadow-2xl py-5 px-3 row-start-2 ml-16">
                <h1 class="font-semibold text-2xl text-center">PHIẾU THANH TOÁN</h1>
                <div class="m-4 flex justify-between items-center ">
                    <h1 class="text-sm">
                        Khu: {{ area }}
                        <br>Bàn: {{ table }}
                    </h1>
                    <h1 class="text-sm">
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
                            <tr v-for="item in billItems">
                                <td>
                                    {{ `${item.BillDetail_Dish.Dish_food.Food_name}
                                    ${item.BillDetail_Dish.Dish_cooking_method.Cooking_method_name}` }}
                                </td>
                                <td class="text-center">{{ formatPrice(item.BillDetail_quantity) }}</td>
                                <td class="text-center">{{ formatPrice(item.BillDetail_Dish.Dish_food.Food_price) }}
                                </td>
                                <td class="text-center">{{ formatPrice(item.BillDetail_price) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mx-7 flex justify-between items-center border-t border-black">
                    <h1 class="text-center translate-y-4 text-xl font-semibold">Tổng cộng:</h1>
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
                <img class="w-full z-0" src="./../../assets/qr.png">
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, RouterLink } from "vue-router";
import { getBillData } from '../../api/checkout';
import { formatDateTime, formatPrice } from '../../api/functions';
const route = useRoute()
const id = route.params.id;

const area = ref("");
const table = ref("");
const time_in = ref("");
const time_leave = ref(formatDateTime(new Date()));
const total = ref("");
const billItems = ref([]);

onMounted(async () => {
    getBillData(id).then(res => {
        area.value = res.Bill_table.Table_branch.Branch_name;
        table.value = res.Bill_table.Table_number;
        time_in.value = res.Bill_time_in;
        total.value = formatPrice(res.Bill_total);
        billItems.value = res.Bill_detail;
    });
})

</script>