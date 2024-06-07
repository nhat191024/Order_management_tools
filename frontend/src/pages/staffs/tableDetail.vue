<template>
    <div class="w-full h-full grid grid-cols-12 grid-rows-10">
        <div class="col-span-4 row-span-1 border-r border-black">
            <button class="items-center bg-white drop-shadow-2x text-black inline-flex">
                <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                    <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span>
            </button>
        </div>
        <div class="col-span-4 row-start-2 row-span-full border-r border-black overflow-auto">
            <div v-for="a in menu"
                class="w-full collapse collapse-arrow bg-primary rounded-none border-b border-black text-white">
                <input type="radio" name="my-accordion-2 " />
                <div class="collapse-title text-xl font-medium shadow-md">
                    {{ a.category }}
                </div>
                <div class="collapse-content bg-secondary p-0 m-0">
                    <div v-for="dish in a.dish" :key="dish.id"
                        class="w-full h-fit p-4 font-medium text-xl flex items-center justify-between border-b border-white ">
                        <p>{{ dish.name }} - {{ dish.price }}VNĐ</p>
                        <button
                            class="w-[10%] flex justify-center transition-all transform linear duration-300 active:scale-90 active:fill-green-600"
                            @click="addDish">
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
        <div class="col-start-5 col-span-5 row-start-2 row-span-full px-4">
            <div class="bg-primary shadow-md rounded-lg flex h-1/6 text-white">
                <img src="../../assets/demo.jpg" alt="demo" class="w-[25%] h-full rounded-l-lg" />
                <div class="flex flex-col justify-center">
                    <p>ốc xào</p>
                    <p>Giá: 1000VNĐ</p>
                    <input class="bg-primary h-fit w-ful placeholder:text-whiteeeeeeeeeeeee" placeholder="Ghi Chú"></input>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const id = route.params.id;

const menu = ref([
    {
        id: 1,
        category: "Appetizer",
        dish: [
            {
                id: 1,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 2,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 2,
        category: "Main Course",
        dish: [
            {
                id: 3,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 4,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 3,
        category: "Dessert",
        dish: [
            {
                id: 5,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 6,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 4,
        category: "Drink",
        dish: [
            {
                id: 7,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 8,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 5,
        category: "Drink",
        dish: [
            {
                id: 9,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 10,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 6,
        category: "Drink",
        dish: [
            {
                id: 11,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 12,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 7,
        category: "Drink",
        dish: [
            {
                id: 13,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 14,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 8,
        category: "Drink",
        dish: [
            {
                id: 15,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 16,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 9,
        category: "Drink",
        dish: [
            {
                id: 17,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 18,
                name: "Fried Chicken",
                price: 10
            }
        ]
    },
    {
        id: 10,
        category: "Drink",
        dish: [
            {
                id: 19,
                name: "Fried Chicken",
                price: 1000
            },
            {
                id: 20,
                name: "Fried Chicken",
                price: 10
            }
        ]
    }
])

function addDish() {
    console.log("add dish");
}
</script>
