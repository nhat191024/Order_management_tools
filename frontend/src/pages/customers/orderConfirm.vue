<template>
  <div class="grid grid-rows-12 w-dvw h-dvh">
    <nav class="bg-primary top-0 left-0 w-full row-span-1 flex items-center justify-between px-4 rounded-b-lg">
      <RouterLink v-bind:to="{path: '/order/' + id+''}" class="" >
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
      <div v-for="(dishes) in tableDish">
        <hr class="mt-3 mb-2" />
        <div class="flex ...">
          <div class="flex-none w-14 h-14 ms-1">
            <img src="/src/assets/demo.jpg" alt="" width="100%" class="rounded-lg" />
          </div>
          <div class="grow h-14 ...">
            <div class="grid grid-cols-12 grid-rows-2">
              <span class="ms-3 col-span-2">x{{ dishes.quantity }} </span>
              <span class="ms-3 col-span-6">{{ dishes.dishName }}</span>
              <div>
                <span class="col-span-4 ">{{ formatPrice(dishes.price) }}Đ</span>
              </div>
              <div class="row-start-2 col-start-1 col-span-12 ml-3">
                <p class="overflow-x-auto whitespace-nowrap">{{ dishes.note }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
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
import { formatPrice } from "../../api/functions";
import { addOrderItems } from "../../api/customer";

const route = useRoute();
const router = useRouter();
const id = route.params.id;

const tableDish = [
  {
    dishName: 'dcm trung',
    dish_id: 1,
    quantity: 1,
    price :3000000,
    note: "nhat gay nhat gay nhat gay nhat gay nhat gay nhat gay",
  },
  {
    dishName: 'dcm trung',
    dish_id: 2,
    quantity: 1,
    price :3000000,
    note: "huy gay",
  },
];

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
      dish_id: dish.dish_id,
      quantity: dish.quantity,
      note: dish.note,
    });
  });

  const result = await addOrderItems(table_id, ...dishes);
  tableDish.value = [];
  if (result.status === 200) {
    router.push(`/order/${id}`);
  }
}
</script>
