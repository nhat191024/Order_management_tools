<template>
    <div class="bg-white rounded-xl drop-shadow-2xl p-5">
        <h1 class="font-serif font-semibold text-2xl text-center">PHIẾU THANH TOÁN</h1>
        <div class="m-4 flex justify-between items-center ">
            <h1 class="text-sm font-sans">
                Khu: {{ billData.areaName }}
                <br>Bàn: {{ billData.tableName }}
            </h1>
            <h1 class="text-sm font-sans">
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
            <h1 class="text-center translate-y-4 text-xl font-semibold">{{ billData.total(billData.items) }} VND</h1>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        billData: Object,
    }
};
</script>