<template>
  <div class="h-screen w-screen overflow-hidden">
    <div>
      <BillDetailsHistoryModal :historyItems="historyItems" @click="fetchHistoryItems" @restore="restoreItem" />
    </div>
    <div class="fixed w-full bg-white shadow-md z-10">
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
    <div class="gap-4 p-0 mt-20 overflow-hidden">
      <PagedGridLayout :items="items" @on-confirm="confirm" @on-cancel="cancel" />
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

  <dialog id="cancel" class="modal">
    <form class="modal-box text-center">
      <h3 class="font-bold text-lg text-orange-500">Xác nhận hủy món?</h3>
      <p class="py-4">
        Hãy chắc chắn rằng bạn đã kiểm tra kỹ trước khi nhấn xác nhận!
      </p>
      <p class="py-4 font-bold">
        Hệ thống sẽ tiến hành hủy món khi bạn xác nhận!
      </p>
      <div class="modal-action border-t border-black pt-4 mt-0">
        <form method="dialog">
          <button class="btn btn-primary text-white mx-2" @click="cancelOrder()">
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
import { getKitchenCurrentOrder, updateOrderStatus, getKitchenName, orderDelete, getKitchenHisoryOrder, restoreKitchenOrder } from "../../api/kitchen";
import { getCookie, checkLogin } from "../../api/functions";
import BillDetailsHistoryModal from "../../components/kitchen/BillDetailsHistoryModal.vue";
import PagedGridLayout from '../../components/kitchen/PagedGridLayout.vue';

checkLogin();
const id = useRoute().params.id;
const branchId = getCookie("Branch_id");

const name = ref("");
const items = ref([]);
const historyItems = ref([]);
const orderId = ref("");

onMounted(() => {
  getKitchenName(id).then((res) => {
    name.value = res.name;
  });
});

async function getCurrentOrder() {
  getKitchenCurrentOrder(branchId, id).then((res) => {
    items.value = res;
    console.log(res);
  });
}
getCurrentOrder();

window.Echo.channel('orders' + id)
  .listen('OrderCreate', (e) => {
    console.log(e);
    items.value.push(e);
  });

function restoreItem(billDetailId) {
  // alert('Restore item with id: ' + billDetailId);
  restoreKitchenOrder(billDetailId).then((res) => {
    getCurrentOrder();
  });
  
}

function fetchHistoryItems() {
  getKitchenHisoryOrder(branchId, id).then((res) => {
    historyItems.value = res;
  });
  // historyItems.value = [
  //   {id: 4, name: 'Ốc mít hấp mẻ', quantity: 1, note: null, table: '2', status: 2},
  //   {id: 5, name: 'Ốc mít luộc lá chanh', quantity: 1, note: null, table: '2', status: 2},
  //   {id: 6, name: 'Ốc mít luộc Mắm', quantity: 1, note: null, table: '2', status: 2},
  //   {id: 9, name: 'Ốc mít luộc Mắm', quantity: 3, note: null, table: '1', status: 2},
  //   {id: 10, name: 'Ốc mít luộc Mắm', quantity: 1, note: null, table: '1', status: 2},
  // ]
}

function confirm(id) {
  // const confirm = document.getElementById('confirm')
  // confirm.showModal();
  orderId.value = id;
  completeOrder()
}

function cancel(id) {
  const confirm = document.getElementById('cancel')
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

async function cancelOrder() {
  orderDelete(orderId.value).then((res) => {
    if (res.message === 'success') {
      getCurrentOrder();
    } else {
      return;
    }
  });
}
</script>
