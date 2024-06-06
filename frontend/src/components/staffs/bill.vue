<template>
<div class="border-1 shadow-md bg-white rounded-xl w-max h-max">
    <span class="text-center flex">Hoá đơn thanh toán</span>
    <table class="table m-1">
        <thead>
            <tr>
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
    <span class="text-center flex">Tổng thanh toán: {{ billData.total(billData.items) }} VND</span>
</div>
</template>

<script>
export default {
    props: {
        billData: Object,
    }
};
</script>