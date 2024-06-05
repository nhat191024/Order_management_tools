<template>
  <div class="h-screen overflow-auto">
    <div class="flex flex-col justify-between">
      <div class="block bg-white w-full fixed shadow-md">
        <div class="flex items-center p-4">
          <a class="flex items-center" href="/">
            <svg
              class="w-11 h-11 fill-white bg-orange-500 rounded-xl m-1 p-1"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                d="M177.5 414c-8.8 3.8-19 2-26-4.6l-144-136C2.7 268.9 0 262.6 0 256s2.7-12.9 7.5-17.4l144-136c7-6.6 17.2-8.4 26-4.6s14.5 12.5 14.5 22l0 72 288 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l-288 0 0 72c0 9.6-5.7 18.2-14.5 22z"
              />
            </svg>
            <span class="text-xl text-black font-medium">Trở về</span>
          </a>
          <h1 class="flex-grow text-center font-bold text-black text-5xl">
            Bếp xào
          </h1>

          <div class="w-20"></div>
        </div>
        <hr class="mt-3" />
      </div>
      <div
        class="grid mt-28 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-8 place-items-center"
      >
        <a href="#" v-for="(item, index) in items" :title="item.title">
          <div
            class="bg-orange-400 text-white font-bold text-center p-3 rounded-xl"
          >
            <img
              src="https://cdn.tgdd.vn/2021/11/CookDish/mach-ban-vat-dung-trang-tri-nha-bep-nen-co-cho-gian-bep-them-avt-1200x676.jpg"
              width="260"
              height="130"
              class="mb-2 rounded-lg"
              alt="Bếp nướng"
            />
            {{ item.title }}
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },
        {
          title: "Bếp nướng",
        },

        // Add more items as needed
      ],
    };
  },
};
</script>
