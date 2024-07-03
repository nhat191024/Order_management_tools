<template>
  <div class="grid grid-cols-12 grid-rows-8 gap-2 h-dvh w-dvw">
    <div class="col-span-2 flex items-center justify-center">
      <button class="items-center bg-white drop-shadow-2x text-black inline-flex">
        <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
          <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" />
        </div>
        <span class="text-xl drop-shadow">Trở về</span>
      </button>
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
import { RouterLink } from "vue-router";
import { getKitchenData } from "../../api/kitchensSelect";
import { getCookie } from "../../api/functions";
const kitchens = ref([]);
const branchId = getCookie("Branch_id");
onMounted(async () => {
  try {
    kitchens.value = await getKitchenData(branchId);
  } catch (error) {
    console.error("Error fetching kitchen data:", error);
  }
});
</script>
