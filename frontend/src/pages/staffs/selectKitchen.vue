<template>
  <div class="grid grid-cols-12 grid-rows-8 gap-2 h-dvh w-dvw">
    <div class="col-span-2 flex items-center justify-center">
      <button
        class="items-center bg-white drop-shadow-2x text-black inline-flex"
      >
        <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
          <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" />
        </div>
        <span class="text-xl drop-shadow">Trở về</span>
      </button>
    </div>
    <div
      class="col-start-6 col-span-2 flex justify-center items-center font-extrabold text-3xl"
    >
      <p>Chọn Bếp</p>
    </div>
    <div
      class="row-span-7 col-start-2 col-span-10 place-items-center overflow-auto grid grid-cols-3 gap-4"
    >
      <RouterLink
        v-for="kitchen in kitchens"
        :key="kitchen.id"
        to=""
        class="w-64 h-40 rounded-xl flex flex-col items-center justify-between drop-shadow-sm bg-primary p-2"
      >
        <img :src="kitchen.img" alt="demo" class="w-full h-4/5 rounded-xl" />
        <span class="text-white font-extrabold text-lg text-center">
          {{ kitchen.name }}
        </span>
      </RouterLink>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import { getKitchenData } from "../../api/kitchensSelect";
const kitchens = ref([]);

onMounted(async () => {
  const branch_id = 1;
  // xử lí api qua id cơ sở

  try {
    kitchens.value = await getKitchenData(branch_id);
  } catch (error) {
    console.error("Error fetching kitchen data:", error);
  }
});

const mainColor = "bg-primary";
const disabled = "bg-gray-300";
</script>
