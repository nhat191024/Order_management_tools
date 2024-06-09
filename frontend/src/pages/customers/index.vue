<template>
    <div class="grid grid-rows-12 w-dvw h-dvh">
        <nav class="bg-primary row-span-1 flex items-center justify-between px-4 rounded-b-lg">
            <img class="rounded-full w-14 h-14" src="/src/assets/logo.jpg" alt="Logo" />
            <p class="text-white text-2xl font-semibold">Bàn {{ id }}</p>
        </nav>
        <div role="tablist" class="tabs tabs-bordered row-span-1 flex items-center overflow-auto">
            <a v-for="(tab, index) in category" role="tab"
                class="tab h-3/5 font-medium transition-all transform linear duration-500" :href="'#' + tab.id"
                :class="tabStatus[index].status ? 'tab-active text-primary' : ''" @click="tabChange(tab.id)">
                {{ tab.name }}
            </a>
        </div>
        <div class="row-span-9 px-3 flex flex-col overflow-auto scroll-smooth">
            <div v-for="category in menu" :id="category.id" class="flex flex-col mb-4 pb-4 border-b border-gray-400">
                <p class="text-xl font-medium mb-4">{{ category.dishCategory }} ({{ category.dishes.length }})</p>
                <div class="flex flex-col gap-4 pb-4">
                    <div v-for="dish in category.dishes"
                        class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light">
                        <img src="../../assets/demo.jpg" alt="demo"
                            class=" row-span-full col-span-3 w-full h-full rounded-lg">
                        <p class="col-start-4 col-span-full row-span-1 pl-3">{{ dish.name }}</p>
                        <p class="col-start-4 col-span-full row-span-1 pl-3 text-sm">{{ dish.note }}</p>
                        <p class=" text-gray-500 pl-3 col-span-4">{{ formatPrice(dish.price) }}đ</p>
                        <button
                            class="col-start-12 flex justify-center items-center bg-primary rounded-lg m-px transition-all transform linear duration-300 active:scale-110">
                            <img src="../../assets/plus-white.svg" alt="" class="w-10/12">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex bg-white border-t-4 items-center justify-center">
            <img src="/src/assets/Vector.svg" alt="Cart" class="h-10" />
            <span class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white">14</span>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const id = route.params.id;
const tabStatus = ref([]);
const category = ref([]);
const menu = ref([
    {
        id: 1,
        dishCategory: "Ốc",
        dishes: [
            {
                id: 1,
                name: "Ốc con",
                note: "",
                price: 30000,
            },
            {
                id: 2,
                name: "Ốc mít",
                note: "",
                price: 90000,
            },
            {
                id: 3,
                name: "Ốc ráo",
                note: "",
                price: 35000,
            },
            {
                id: 4,
                name: "Ốc hương xào trứng muối",
                note: "",
                price: 180000,
            },
            {
                id: 5,
                name: "Ốc lẫn",
                note: "",
                price: 60000,
            },
            {
                id: 6,
                name: "Ốc đỏ môi",
                note: "",
                price: 70000,
            },
            {
                id: 7,
                name: "Ốc mút giấy",
                note: "",
                price: 60000,
            },
            {
                id: 8,
                name: "Ốc ngố",
                note: "",
                price: 40000,
            },
            {
                id: 9,
                name: "Ốc hương",
                note: "",
                price: 180000,
            },
            {
                id: 10,
                name: "Ốc mút len",
                note: "",
                price: 120000,
            },
            {
                id: 11,
                name: "Ốc đĩa",
                note: "Size lớn",
                price: 180000,
            },
            {
                id: 12,
                name: "Ốc đĩa",
                note: "Size nhỏ",
                price: 150000,
            },
            {
                id: 13,
                name: "Cà la",
                note: "",
                price: 120000,
            },
            {
                id: 12,
                name: "Ốc Bông",
                note: "",
                price: 180000,
            },
            {
                id: 12,
                name: "Ốc sư tử nướng",
                note: "",
                price: 120000,
            },
        ]
    },
    {
        id: 2,
        dishCategory: "Sò - Ngao - Hàu",
        dishes: [
            {
                id: 1,
                name: "Hàu nướng",
                note: "",
                price: 60000
            },
            {
                id: 2,
                name: "Ngao hấp kiểu thái",
                note: "",
                price: 70000
            },
            {
                id: 3,
                name: "Sò mít nướng",
                note: "",
                price: 70000
            },
            {
                id: 4,
                name: "Sò gạo",
                note: "",
                price: 80000
            },
            {
                id: 5,
                name: "Sò lông",
                note: "",
                price: 70000
            },
            {
                id: 6,
                name: "Móng tay xào rau húng",
                note: "",
                price: 120000
            },
            {
                id: 7,
                name: "Sò Huyết",
                note: "",
                price: 180000
            },
            {
                id: 8,
                name: "Ngao trắng",
                note: "",
                price: 70000
            },
            {
                id: 9,
                name: "Thưng hấp thái chua cay",
                note: "",
                price: 120000
            },
            {
                id: 10,
                name: "Sò dưa",
                note: "",
                price: 70000
            },
            {
                id: 11,
                name: "Thưng nướng",
                note: "",
                price: 120000
            },
        ]
    },
    {
        id: 3,
        dishCategory: "Ăn Vặt",
        dishes: [
            {
                id: 1,
                name: "Cút lộn xào me",
                note: "",
                price: 50000
            },
            {
                id: 2,
                name: "Ném rán Hà Nội",
                note: "Đĩa nhỏ",
                price: 40000
            },
            {
                id: 3,
                name: "Ném rán Hà Nội",
                note: "Đĩa to",
                price: 70000
            },
            {
                id: 4,
                name: "Xoài dầm",
                note: "",
                price: 25000
            },
            {
                id: 5,
                name: "Bánh mì",
                note: "3  cái bánh mì cóc",
                price: 19000
            },
            {
                id: 6,
                name: "Củ đậu",
                note: "",
                price: 25000
            },
            {
                id: 7,
                name: "Cú lộn luộc",
                note: "",
                price: 50000
            },
            {
                id: 8,
                name: "Càng cù kỳ",
                note: "",
                price: 150000
            },
            {
                id: 9,
                name: "Bề bề rang me",
                note: "",
                price: 165000
            },
            {
                id: 10,
                name: "Cá bóng nướng",
                note: "",
                price: 60000
            },
            {
                id: 11,
                name: "Cá chỉ vàng nướng",
                note: "",
                price: 60000
            },
        ]
    },
    {
        id: 4,
        dishCategory: "Đồ uống",
        dishes: [
            {
                id: 1,
                name: "Nước nhân trần",
                note: "",
                price: 5000
            },
            {
                id: 2,
                name: "Trà tắc",
                note: "",
                price: 12000
            },
            {
                id: 3,
                name: "Bia 333",
                note: "1 lon",
                price: 18000
            },
            {
                id: 4,
                name: "Coca lon",
                note: "",
                price: 12000
            },
            {
                id: 5,
                name: "Trà tắc thạch cá",
                note: "",
                price: 18000
            },
            {
                id: 6,
                name: "Nước cam ép",
                note: "",
                price: 25000
            }
        ]
    }
]);

if (menu.value.length > 0) {
    menu.value.forEach((item) => {
        category.value.push({ id: item.id, name: item.dishCategory });
    });
}
function pushTabStatus() {
    category.value.forEach((item) => {
        if (item.id === 1) {
            tabStatus.value.push({ id: item.id, status: true });
        } else
            tabStatus.value.push({ id: item.id, status: false });
    });
}
pushTabStatus();

function tabChange(id) {
    tabStatus.value.forEach((item) => {
        if (item.id === id) {
            item.status = true;
        } else {
            item.status = false;
        }
    });
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>