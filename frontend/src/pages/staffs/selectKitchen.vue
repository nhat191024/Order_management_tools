<template>
  <div class="grid grid-cols-12 grid-rows-8 gap-2 h-dvh w-dvw">
    <div class="col-span-2 flex items-center justify-center">
      <div class="dropdown">
        <div tabindex="0" role="button" class="m-1">
          <img class="bg-white w-16 h-16 mr-2 rounded-full border shadow-lg" src="../../assets/logo.jpg"></img>
        </div>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
          <li><a>Xin chào {{ username }} !</a></li>
          <li><button @click="logout">Đăng Xuất</button></li>
        </ul>
      </div>
      <p class="font-bold text-xl">Thương ốc</p>
    </div>
    <div class="col-start-5 col-span-4 self-center mx-auto font-extrabold text-3xl">
      <p>Chọn Bếp</p>
    </div>
    <div class="row-span-7 col-span-full place-items-center overflow-auto grid grid-cols-3 grid-rows-10">
      <a v-for="kitchen in kitchens" :key="kitchen.id" :href="'/staff/kitchen/' + kitchen.id"
        class="w-64 h-40 row-span-4 rounded-xl flex flex-col items-center justify-between drop-shadow-sm bg-primary p-2">
        <img src="../../assets/demo.jpg" alt="demo" class="w-full h-4/5 rounded-xl" />
        <span class="text-white font-extrabold text-lg text-center">
          {{ kitchen.name }}
        </span>
      </a>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router';
import { logoutHandle } from '../../api/login';
import { getKitchenData } from "../../api/kitchen";
import { getCookie } from "../../api/functions";

const router = useRouter();
const kitchens = ref([])
const branchId = getCookie("Branch_id");
const username = getCookie('Username');

onMounted(async () => {
  try {
    kitchens.value = await getKitchenData(branchId);
  } catch (error) {
    console.error("Error fetching kitchen data:", error);
  }
});

function logout() {
  logoutHandle();
  router.push('/staff/login');
}
</script>
