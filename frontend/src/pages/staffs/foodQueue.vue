<template>
  <div class="h-screen w-screen overflow-scroll">
    <div class="fixed w-full bg-white shadow-md">
      <div class="flex items-center p-2">
        <div class="flex items-center justify-center col-span-2">
          <a class="flex items-center text-black bg-white drop-shadow-2x" href="/staff/kitchen">
            <div class="flex items-center justify-center w-8 h-8 m-1 bg-primary rounded-xl drop-shadow-2xl p-1">
              <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" />
            </div>
            <span class="text-lg drop-shadow">Trở về</span>
          </a>
        </div>
        <h1 class="flex-grow text-3xl font-bold text-center text-black">
          Bếp {{ name }}
        </h1>
        <div class="w-16"></div>
      </div>
      <hr class="mt-2" />
    </div>
    <div class="grid gap-4 p-4 mt-20 place-items-center grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <div v-for="(item, index) in items"
        class="flex flex-col items-center p-3 m-2 text-center text-white bg-primary rounded-lg shadow-lg w-64 relative">
        <div class="text-xl font-bold w-full flex justify-between"><span>{{ index+1 }}</span><span>Bàn {{ item.table
            }}</span></div>
        <div class="w-full border-t border-white"></div>
        <div class="text-lg font-bold mt-3">{{ item.quantity }}x {{ item.name }}</div>
        <div class="w-full my-2 border-t border-white"></div>
        <div class="text-lg">{{ item.note ? item.note : 'Không có ghi chú' }}</div>
        <div class="flex items-center justify-end w-full mt-2">
          <div class="flex items-center justify-center min-w-12 h-12 p-2 bg-white rounded-full"
            @click="confirm(item.id)">
            <img src="./../../assets/check.svg" alt="Check Icon" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <dialog id="confirm" class="modal">
    <form class="modal-box text-center">
      <h3 class="font-bold text-lg text-orange-500">Xác nhận hoàn thành món?</h3>
      <p class="py-4">
        Hãy chắc chắn rằng bạn đã kiểm tra kỹ trước khi nhấn xác nhận!
      </p>
      <p class="py-4 font-bold">
        Hệ thống sẽ tiến hành in đơn khi bạn xác nhận!
      </p>
      <div class="modal-action border-t border-black pt-4 mt-0">
        <form method="dialog">
          <button class="btn btn-primary text-white mx-2" @click="completeOrder()">
            Xác Nhận
          </button>
          <button class="btn btn-error text-white">Hủy</button>
        </form>
      </div>
    </form>
  </dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { getKitchenCurrentOrder, updateOrderStatus, getKitchenName } from "../../api/kitchen";
import { getCookie, checkLogin } from "../../api/functions";

checkLogin();
const id = useRoute().params.id;
const branchId = getCookie("Branch_id");

const name = ref("");
const items = ref([]);
const orderId = ref("");

onMounted(() => {
  getKitchenName(id).then((res) => {
    name.value = res.name;
  });
});

async function getCurrentOrder() {
  getKitchenCurrentOrder(branchId, id).then((res) => {
    // items.value.push(...res);
    items.value = res;
  });
}
getCurrentOrder();

window.Echo.channel('orders' + id)
  .listen('OrderCreate', (e) => {
    items.value.push(e);
    console.log(e);
  });

function confirm(id) {
  const confirm = document.getElementById('confirm')
  confirm.showModal();
  orderId.value = id;
}

async function completeOrder() {
  updateOrderStatus(orderId.value).then((res) => {
    if (res.message === 'success') {
      getCurrentOrder();
    } else {
      return;
    }
  });
}
</script>
