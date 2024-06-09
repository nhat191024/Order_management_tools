<template>
  <div class="grid grid-cols-12 grid-rows-8 gap-2 h-dvh w-dvw ">
    <div class="col-span-2 flex items-center justify-center ">
      <button class="items-center bg-white drop-shadow-2x text-black inline-flex">
        <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
          <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
        </div>
        <span class="text-xl drop-shadow">Trở về</span>
      </button>
    </div>
    <div class="col-start-6 col-span-2 flex  justify-center items-center font-extrabold text-3xl">
      <p>Chọn Bếp</p>
    </div>
    <div class="row-span-7 col-start-2 col-span-10 place-items-center overflow-auto grid grid-cols-3 gap-4">
      <RouterLink v-for="kitchen in kitchens" to=""
        class="w-64 h-40 rounded-xl flex flex-col items-center justify-between drop-shadow-sm bg-primary p-2">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSr4v-CwguS8bic62WkC1PwUSIPZOli4GuthA&s"
          alt="demo" class="w-full h-4/5 rounded-xl">
        <span class="text-white font-extrabold text-xl text-center">{{ kitchen.name }}</span>
      </RouterLink>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const mainColor = 'bg-primary'
const disabled = 'bg-gray-300'

const kitchens = ref([
  {
    name: "Bàn 1",
    status: 1
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 1",
    status: 1
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 1",
    status: 1
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 2",
    status: 0
  },
  {
    name: "Bàn 2",
    status: 0
  },

])
</script>