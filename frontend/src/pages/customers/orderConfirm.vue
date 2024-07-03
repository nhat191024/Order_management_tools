<template>
  <div class="grid grid-rows-12 w-dvw h-dvh">
    <nav class="bg-primary top-0 left-0 w-full row-span-1 flex items-center justify-between px-4 rounded-b-lg">
      <RouterLink v-bind:to="{path: '/order/' + id+''}" class="">
        <img class="rounded-full w-14 h-14" src="/src/assets/backButton.svg" alt="Logo" />
      </RouterLink>

      <p class="text-white text-2xl font-semibold">Bàn {{ id }}</p>
    </nav>
    <div class="flex-auto my-3">
      <p class="text-black text-2xl font-semibold text-center">
        Xác nhận đơn hàng
      </p>
    </div>
    <div class="row-start-3 row-span-8 px-3 flex flex-col overflow-auto scroll-smooth">
      <template v-for="(dishes, key) in tableDish">
        <hr class="mt-3 mb-2" />
        <div class="flex items-center">
          <img src="/src/assets/demo.jpg" alt="" width="100%" class="w-12 h-12 rounded-lg" />
          <div class="flex-col ml-3 mt-3 w-[80%]">
            <p class="text-lg font-semibold">x{{ dishes.quantity }} {{ dishes.dishName }}</p>
            <p class=" text-sm font-extralight truncate">Ghi chú: {{ dishes.note }}</p>
            <p class="text-lg">{{ formatPrice(dishes.price) }} VNĐ</p>
          </div>
        </div>
      </template>
    </div>
    <footer class="row-start-11 bg-white">
      <hr class="" />
      <div class="bg-white px-2">
        <span class="text-2xl">Tổng cộng :</span>
        <span class="float-right me-2 text-2xl">
          <p style="color: #ff5c00">{{ formatPrice(tempTotal()) }} VNĐ</p>
        </span>
      </div>
      <div class="grid grid-cols-1 m-2 my-3">
        <button class="btn btn-primary" @click="addOrders()">
          <p style="color: white">Thanh toán</p>
        </button>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { formatPrice, getCookie } from "../../api/functions";
import { addOrderItems } from "../../api/customer";
import { useOrderStore } from "../../stores/order";

const orderStore = useOrderStore();
const route = useRoute();
const router = useRouter();
const id = route.params.id;

const branch_id = getCookie('Branch_id');

const tableDish = orderStore.dishes;

function tempTotal() {
    let total = 0;
    tableDish.forEach((item) => {
        total += item.price * item.quantity;
    });
    return total;
}

async function addOrders() {
  let table_id = id;
  let dishes = [];

  tableDish.forEach((dish) => {
    dishes.push({
      dish_id: dish.dishId,
      quantity: dish.quantity,
      note: dish.note,
    });
  });

  const result = await addOrderItems(table_id, branch_id, ...dishes);
  tableDish.value = [];
  if (result.status === 200) {
    orderStore.clearDishes();
    router.push(`/order/${id}`);
  }
}
</script>
