<template>
  <div class="h-screen w-screen overflow-scroll">
    <div class="fixed w-full bg-white shadow-md">
      <div class="flex items-center p-2">
        <div class="flex items-center justify-center col-span-2">
          <button class="flex items-center text-black bg-white drop-shadow-2x">
            <div class="flex items-center justify-center w-8 h-8 m-1 bg-primary rounded-xl drop-shadow-2xl p-1">
              <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" />
            </div>
            <span class="text-lg drop-shadow">Trở về</span>
          </button>
        </div>
        <h1 class="flex-grow text-3xl font-bold text-center text-black">
          Bếp xào
        </h1>
        <div class="w-16"></div>
      </div>
      <hr class="mt-2" />
    </div>


    <div class="grid gap-4 p-4 mt-20 place-items-center grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <div v-for="(item, index) in items" :key="index"
        class="flex flex-col items-center p-4 m-2 text-center text-white bg-primary rounded-lg shadow-lg w-64 relative">
        <p class="absolute top-0 left-0 mt-2 ml-2 text-xl">{{ index + 1 }}</p>
        <div class="text-lg font-bold">{{ item.title }}</div>
        <div class="w-full my-2 border-t border-white"></div>
        <div class="text-lg">{{ item.description }}</div>

        <div class="flex items-center justify-between w-full">
          <div class="w-full my-2 border-t border-white"></div>
          <div class="flex items-center justify-center min-w-14 h-14 p-2 bg-white rounded-full"
            @click="removeItem(index)">
            <img src="./../../assets/check.svg" alt="Check Icon" />
          </div>
        </div>
        <div class="text-xl font-bold">{{ item.table }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const items = ref([
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 1",
    visible: true,
  },
  {
    title: "Ốc bươu xào",
    description: "Không nướng",
    table: "Bàn 2",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 3",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 1",
    visible: true,
  },
  {
    title: "Ốc bươu xào",
    description: "Không nướng",
    table: "Bàn 2",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 3",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 1",
    visible: true,
  },
  {
    title: "Ốc bươu xào",
    description: "Không nướng",
    table: "Bàn 2",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 3",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 1",
    visible: true,
  },
  {
    title: "Ốc bươu xào",
    description: "Không nướng",
    table: "Bàn 2",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 3",
    visible: true,
  },
  {
    title: "Ốc sên xào",
    description: "Không nướng",
    table: "Bàn 1",
    visible: true,
  },
  {
    title: "Ốc bươu xào",
    description: "Không nướng",
    table: "Bàn 2",
    visible: true,
  },
]);

const removeItem = (index) => {
  items.value.splice(index, 1);
};
</script>
