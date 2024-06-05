<template>
  <div
    class="bg-orange-500 text-white rounded-lg shadow-lg p-4 w-64 text-center m-2 cursor-pointer"
  >
    <div class="text-lg font-bold">{{ title }}</div>
    <div class="border-t border-white my-2"></div>
    <div class="text-lg">{{ description }}</div>
    <div class="border-t border-white my-2"></div>
    <div class="flex justify-between items-center space-x-2">
      <div class="text-xl font-bold content-center">{{ table }}</div>
      <div class="bg-white rounded-full p-2 w-10 h-10">
        <svg
          class="text-green-500"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 448 512"
          fill="currentColor"
        >
          <path
            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"
          />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    description: String,
    table: String,
  },
};
</script>
