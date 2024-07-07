<template>
    <div class="grid grid-cols-12 grid-rows-12 gap-5 h-screen w-screen">
        <div class="col-span-6 row-span-12 grid z-10">
            <div class="p-4 h-0">
                <RouterLink class="items-center bg-white drop-shadow-2x text-black inline-flex"
                    :to="`/staff/table/${id}`">
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
                                <td class="text-center">{{ formatPrice(item.BillDetail_price * item.BillDetail_quantity)
                                    }}</td>
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
                <button class="btn btn-primary text-white shadow-md w-1/2 ml-16 text-xl"
                    @click="confirmPrint(billId, time_leave)">In Hoá Đơn</button>
            </div>
        </div>
        <div class="flex justify-center items-center col-span-6 row-span-12 z-0">
            <div>
                <img class="w-full max-h-screen z-0" src="./../../assets/qr.png">
            </div>
        </div>
    </div>

    <dialog id="confirm" class="modal">
        <form class="modal-box text-center">
            <h3 class="font-bold text-lg text-orange-500">Xác nhận in?</h3>
            <p class="py-4">
                Hãy chắc chắn rằng bạn đã kiểm tra kỹ thông tin trước khi in hóa đơn!
            </p>
            <p class="py-4">
                Và hãy chắc chắn rằng hóa đơn đã được thanh toán
            </p>
            <div class="modal-action border-t border-black pt-4 mt-0">
                <form method="dialog">
                    <button class="btn btn-primary text-white mx-2" @click="checkoutAndPrint(billId, time_leave)">Xác
                        Nhận</button>
                    <button class="btn btn-error text-white">Hủy</button>
                </form>
            </div>
        </form>
    </dialog>

    <dialog id="success" class="modal">
        <div class="modal-box text-center">
            <h3 class="text-lg font-bold text-orange-500">In hóa đơn & thanh toán thành công</h3>
            <p class="py-4">
                Bấm bất kỳ đâu ngoài hộp thoại để đóng và quay lại trang chính
            </p>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button @click="returnToTable()"></button>
        </form>
    </dialog>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, RouterLink } from "vue-router";
import { getBillData, checkout } from '../../api/checkout';
import { formatDateTime, formatPrice, checkLogin } from '../../api/functions';

checkLogin();
const route = useRoute()
const id = route.params.id;

const area = ref("");
const table = ref("");
const time_in = ref("");
const time_leave = ref(formatDateTime(new Date()));
const total = ref("");
const billItems = ref([]);
const billId = ref("");

onMounted(async () => {
    getBillData(id).then(res => {
        let data = [];
        billId.value = res.Table_bill.Bill_id;
        area.value = res.Table_branch.Branch_name;
        table.value = res.Table_number;
        time_in.value = res.Table_bill.Bill_time_in;
        total.value = formatPrice(res.Table_bill.Bill_total);
        res.Table_bill.Bill_detail.forEach((dish) => {
            const index = data.findIndex((item) => item.BillDetail_Dish.Dish_id === dish.BillDetail_Dish.Dish_id);
            if (index === -1) {
                data.push(dish);
            } else {
                data[index].BillDetail_quantity += dish.BillDetail_quantity;
            }
        });
        billItems.value = data;
    });
})

function confirmPrint() {
    const confirm = document.getElementById('confirm');
    confirm.showModal();
}

function checkoutAndPrint(id, timeOut) {
    const success = document.getElementById('success');
    checkout(id, timeOut).then(res => {
        if (res.status === 200) {
            // window.print();
            success.showModal();
        } else {
            alert("Thanh toán thất bại");
        }
    })
}

function returnToTable() {
    window.location.href = `/staff/table`;
}
</script>