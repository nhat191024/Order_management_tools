<template>
  <div class="h-screen w-screen overflow-scroll">
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
      class="p-4 mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 place-items-center"
    >
      <Card
        v-for="(item, index) in items"
        :key="index"
        :title="item.title"
        :description="item.description"
        :table="item.table"
      />
    </div>
  </div>
</template>

<script>
import Card from "../../components/staffs/CardFoodWaiting.vue";

export default {
  components: {
    Card,
  },
  data() {
    return {
      items: [
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 1",
          checked: true,
        },
        {
          title: "Ốc bươu xào",
          description: "Không nướng",
          table: "Bàn 2",
          checked: false,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 3",
          checked: true,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 1",
          checked: true,
        },
        {
          title: "Ốc bươu xào",
          description: "Không nướng",
          table: "Bàn 2",
          checked: false,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 3",
          checked: true,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 1",
          checked: true,
        },
        {
          title: "Ốc bươu xào",
          description: "Không nướng",
          table: "Bàn 2",
          checked: false,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 3",
          checked: true,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 1",
          checked: true,
        },
        {
          title: "Ốc bươu xào",
          description: "Không nướng",
          table: "Bàn 2",
          checked: false,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 3",
          checked: true,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 1",
          checked: true,
        },
        {
          title: "Ốc bươu xào",
          description: "Không nướng",
          table: "Bàn 2",
          checked: false,
        },
        {
          title: "Ốc sên xào",
          description: "Không nướng",
          table: "Bàn 3",
          checked: true,
        },
        // Add more items as needed
      ],
    };
  },
  methods: {
    toggleCheck(index) {
      this.items[index].checked = !this.items[index].checked;
    },
  },
};
</script>
