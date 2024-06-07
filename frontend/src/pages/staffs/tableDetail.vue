<template>
    <div class="w-full h-full grid grid-cols-12 grid-rows-10">
        <div class="col-span-3 row-span-1 border-r border-black flex">
            <RouterLink class="items-center bg-white drop-shadow-2x text-black inline-flex" to="/staff/table">
                <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                    <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span>
            </RouterLink>
        </div>
        <div class="col-span-3 row-start-2 row-span-full border-r border-black overflow-auto">
            <div v-for="cate in menu"
                class="w-full collapse collapse-arrow bg-primary rounded-none border-b border-black text-white">
                <input type="radio" name="my-accordion-2 " />
                <div class="collapse-title text-xl font-medium shadow-md">
                    {{ cate.dishCategory }}
                </div>
                <div class="collapse-content bg-secondary p-0 m-0">
                    <div v-for="dish in cate.dishes" :key="dish.id"
                        class="w-full h-fit p-4 font-medium text-xl flex items-center justify-between border-b border-white ">
                        <div>
                            <p class="w-[95%]">{{ dish.name }}</p>
                            <p>{{ formatPrice(dish.price) }} VNĐ</p>
                        </div>
                        <button
                            class="w-8 h-8 flex justify-center transition-all transform linear duration-300 active:scale-90 active:fill-green-600"
                            @click="addDish(cate.id, dish.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class=" fill-white active:fill-green-600">
                                <!-- Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-start-4 col-span-5 self-center text-center font-bold text-4xl text-primary">
            Bàn {{ id }}
        </div>
        <div class="col-start-4 col-span-5 row-start-2 row-span-full px-4 overflow-auto">
            <div v-for="(dishes, index) in tableDish"
                class="h-32 mb-2 bg-primary shadow-md rounded-lg flex flex-col text-white">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <img src="../../assets/demo.jpg" alt="demo" class="ml-3 mt-3 w-16 h-16 rounded-lg" />
                        <div class="flex flex-col justify-center mt-2">
                            <p class="font-extrabold w-52">{{ dishes.category + " " + dishes.name }}</p>
                            <p>Giá: {{ formatPrice(dishes.price) }} VNĐ</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mr-2">
                        <div class="flex items-center gap-3 px-2 py-1 rounded-full bg-white">
                            <button class="transition-all transform linear duration-300 active:scale-150"
                                @click="decreaseQuantity(index)">
                                <img src="../../assets/minus.svg" alt="minus" class=" w-4">
                            </button>
                            <p class="text-center text-primary ">{{ dishes.quantity }}</p>
                            <button class="transition-all transform linear duration-300 active:scale-150"
                                @click="increaseQuantity(index)">
                                <img src="../../assets/plus.svg" alt="plus" class="w-4">
                            </button>
                        </div>
                        <button class="grow-0 w-6 transition-all transform linear duration-300 active:scale-125"
                            @click="deleteDish(dishes.id)">
                            <img src="../../assets/trash.svg" alt="" class="w-full">
                        </button>
                    </div>
                </div>
                <div class="flex items-center pl-2">
                    <p class="shrink-0 font-bold">Ghi chú:</p>
                    <input class="bg-primary rounded-b-lg mt-1 w-full h-fit px-2 pb-2 focus:outline-none">
                </div>
            </div>
        </div>
        <div class="col-start-9 col-span-4 flex flex-col justify-end font-bold text-primary text-xl gap-2">
            <p class="pl-3">Đơn hàng ({{ tableDish.length }} món)</p>
            <hr class=" w-3/4 ">
        </div>
        <div class="col-start-9 col-span-4 row-start-2 row-span-8 mt-4 px-3 font-medium text-lg overflow-auto">
            <div v-for="dishes in tableDish" class="flex mb-2 border-b border-primary">
                <p class=" w-4/6">{{ dishes.category + " " + dishes.name }}</p>
                <p class="pr-3">x{{ dishes.quantity }}</p>
                <p class="font-bold">{{ formatPrice(dishes.price) }}</p>
            </div>
        </div>
        <div class="col-start-9 col-span-4 row-start-9 row-auto px-6 flex flex-col justify-start">
            <div class="flex gap-4 justify-end mr-4 border-b border-black font-bold">
                <p>Tổng tiền: </p>
                <p>{{ formatPrice(total) }}VNĐ</p>
            </div>
            <button class="btn btn-primary text-white font-bold text-xl mt-4 disabled:bg-secondary"
                :disabled="total === 0" onclick="my_modal_1.showModal()">
                Thanh Toán
            </button>
        </div>
    </div>
    <dialog id="my_modal_1" class="modal">
        <form class="modal-box">
            <h3 class="font-bold text-lg">Chọn phương thức và xác nhận thanh toán</h3>
            <p class="py-4">
            <div class="flex justify-center gap-20 mt-2">
                <div class="flex gap-2">
                    <input type="radio" name="radio-3" class="radio radio-secondary" checked />
                    <p class="font-bold text-lg">Tiền Mặt</p>
                </div>
                <div class="flex gap-2 text-lg">
                    <input type="radio" name="radio-3" class="radio radio-secondary" />
                    <p class="font-bold">Chuyển Khoản</p>
                </div>
            </div>
            </p>
            <div class="modal-action border-t border-black pt-4 mt-0">
                <button class="btn btn-primary text-white">Xác Nhận</button>
                <form method="dialog">
                    <button class="btn btn-error text-white">Close</button>
                </form>
            </div>
        </form>
    </dialog>
</template>
<script setup>
import { ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const id = route.params.id;
const total = ref(0);
const tableDish = ref([]);
const menu = ref([
    {
        id: 1,
        dishCategory: "Hàu",
        dishes: [
            {
                id: 1,
                name: "Nướng mỡ hành / 6 con",
                price: 50000
            },
            {
                id: 2,
                name: "Nướng mỡ hành / 8 con",
                price: 80000
            }
        ]
    },
    {
        id: 2,
        dishCategory: "Ốc hương",
        dishes: [
            {
                id: 3,
                name: "Xào Trứng Muối",
                price: 160000
            },
            {
                id: 4,
                name: "Nướng",
                price: 160000
            },
            {
                id: 5,
                name: "Hấp xả",
                price: 80000
            }
        ]
    },
    {
        id: 3,
        dishCategory: "Càng cù kỳ",
        dishes: [
            {
                id: 6,
                name: "Sốt me",
                price: 150000
            }
        ]
    },
    {
        id: 4,
        dishCategory: "Ốc đĩa",
        dishes: [
            {
                id: 7,
                name: "Luộc mắm",
                price: 130000
            },
            {
                id: 8,
                name: "Xào dừa",
                price: 150000
            }
        ]
    },
]);

function addDish(category, dish) {
    const dishDuplicate = tableDish.value.find((d) => d.id === dish);
    if (dishDuplicate) {
        dishDuplicate.quantity++;
        calculateTotal();
        return;
    }
    const selectedCategory = menu.value.find((cate) => cate.id === category);
    if (selectedCategory) {
        const selectedDish = selectedCategory.dishes.find((d) => d.id === dish);
        if (selectedDish) {
            const dishWithQuantity = { ...selectedDish, category: selectedCategory.dishCategory, quantity: 1 };
            tableDish.value.push(dishWithQuantity);
            console.log(tableDish.value);
        }
    }
    calculateTotal();
}

function increaseQuantity(index) {
    tableDish.value[index].quantity++;
    calculateTotal();
}

function decreaseQuantity(index) {
    if (tableDish.value[index].quantity > 1) {
        tableDish.value[index].quantity--;
    }
    calculateTotal();
}

function deleteDish(id) {
    tableDish.value = tableDish.value.filter((dish) => dish.id !== id);
    calculateTotal();
}

function calculateTotal() {
    total.value = tableDish.value.reduce((acc, dish) => {
        return acc + dish.price * dish.quantity;
    }, 0);
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>