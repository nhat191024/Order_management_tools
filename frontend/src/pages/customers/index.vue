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
                        <button @click="dish.cookingMethods != null ? DetailDish(dish.id) : addDish(dish.id)"
                            class="col-start-12 flex justify-center items-center bg-primary rounded-lg m-px transition-all transform linear duration-300 active:scale-110">
                            <img src="../../assets/plus-white.svg" alt="" class="w-10/12">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button class="flex bg-white border-t-4 items-center justify-center dropdown dropdown-top" @click="showCart()">
            <img src="/src/assets/Vector.svg" alt="Cart" class="h-10" />
            <span class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white">
                {{ totalDish() < 10 ? '0' + totalDish() : totalDish() }} </span>
        </button>
        <dialog id="dishDetail" class="modal modal-bottom">
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
            <div class="modal-box p-0">
                <form method="dialog">
                    <button class="btn btn-md btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-xl text-center pt-2">Thêm món ăn</h3>
                <div class="flex flex-col">
                    <div class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light my-5 px-4">
                        <img src="../../assets/demo.jpg" alt="demo"
                            class=" row-span-full col-span-3 w-full h-full rounded-lg">
                        <p class="col-start-4 col-span-full row-span-1 pl-3">{{ dishDetail.name }}</p>
                        <p class=" text-gray-500 pl-3 col-span-4 row-start-3">{{ formatPrice(dishDetail.price) }}đ</p>
                        <div
                            class="col-start-10 col-span-full row-start-3 place-self-center w-full h-full flex items-center gap-3">
                            <button @click="tempQuantity--"
                                class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125">
                                <img src="../../assets/minus.svg" alt="" class="w-4">
                            </button>
                            <p class="join-item">{{ tempQuantity }}</p>
                            <button @click="tempQuantity++"
                                class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125">
                                <img src="../../assets/plus-white.svg" alt="plus" class="w-4">
                            </button>
                        </div>
                    </div>
                    <div class=" bg-stone-200 px-4 py-2">
                        <p>Cách chế biến (chọn 1)</p>
                    </div>
                    <div class="flex flex-col">
                        <div :class="cookingMethod.name == null ? 'hidden' : ''"
                            v-for="cookingMethod in dishDetail.cookingMethods"
                            class="flex flex-col border-b border-gray-300 px-4 py-2">
                            <p class="text-black font-medium">{{ cookingMethod.name }}</p>
                            <div class="flex justify-between">
                                <p class=" text-gray-500">{{ formatPrice(cookingMethod.price) }}đ</p>
                                <input type="radio" name="cookingMethods" v-model="tempCookingMethod"
                                    :value="cookingMethod.id" class="radio border-primary radio-primary" />
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="" class="px-4">Ghi Chú:</label>
                        <textarea class="outline-none w-full textarea-md py-1" placeholder="📝Ghi chú cho quán"
                            v-model="tempNote"></textarea>
                    </div>
                </div>
                <div class="modal-action p-4 mt-0 border-t-2 border-grey-400">
                    <form method="dialog" class="w-full">
                        <button :class="tempCookingMethod == 0 ? 'btn-disabled' : ''" class="btn-secondary btn w-full"
                            @click="addDish()">
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                </div>
            </div>
        </dialog>
        <dialog id="cart" class="modal modal-bottom">
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
            <div class="modal-box p-0">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-xl text-center pt-2">Giỏ hàng</h3>
                <div class="flex flex-col">
                    <div v-for="dish in billTemp"
                        class="w-full h-24 grid grid-rows-4 grid-cols-12 text-lg font-light my-5 px-4">
                        <img src="../../assets/demo.jpg" alt="demo"
                            class=" row-span-full col-span-3 w-full h-full rounded-lg">
                        <p class="col-start-4 col-span-full row-span-1 pl-3">{{ dish.dishName }}</p>
                        <p class="col-start-4 col-span-full pl-3 text-sm text-gray-500 ">{{
                            cookingMethodName(dish.dishId, dish.cookingMethod) }}</p>
                        <input class="pl-3 row-start-3 col-start-4 col-span-full outline-none" placeholder="Ghi chú"
                            v-model="dish.note">
                        <p class=" text-gray-500 pl-3 col-span-4 row-start-4">{{ formatPrice(dish.price) }}đ</p>
                        <div
                            class="col-start-10 col-span-full row-start-4 place-self-center w-full h-full flex items-center gap-3">
                            <button @click="dishDelete(dish.dishId)"
                                class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125">
                                <img src="../../assets/minus.svg" alt="" class="w-4">
                            </button>
                            <p class="join-item">{{ dish.quantity }}</p>
                            <button @click="dish.quantity++"
                                class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125">
                                <img src="../../assets/plus-white.svg" alt="plus" class="w-4">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between px-4 py-2 text-lg border-t border-grey-400">
                    <p>Tổng cộng :</p>
                    <p class="text-primary font-medium">{{ formatPrice(tempTotal()) }}đ</p>
                </div>
                <div class="modal-action p-4 mt-2 border-t-2 border-grey-400">
                    <button class="btn-secondary btn w-full">
                        Đặt món
                    </button>
                </div>
            </div>
        </dialog>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import data from "../../data/menu.json"

const route = useRoute()
const id = route.params.id;
const tabStatus = ref([]);
const category = ref([]);
const tempQuantity = ref(1);
const tempCookingMethod = ref("");
const tempNote = ref("");
const billTemp = ref([]);
const dishDetail = ref({});
const menu = ref(data);

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

function totalDish() {
    let total = 0;
    billTemp.value.forEach((item) => {
        total += item.quantity;
    });
    return total;
}

function DetailDish(id) {
    const dish = menu.value.flatMap((item) => item.dishes).find((item) => item.id === id);
    dishDetail.value = dish
    showDishDetail();
}

function showDishDetail() {
    const dishDetail = document.getElementById('dishDetail');
    dishDetail.showModal();
}

function addDish(id) {
    if (Object.keys(dishDetail.value).length === 0) {
        const dish = menu.value.flatMap((item) => item.dishes).find((item) => item.id === id);
        dishDetail.value = dish;
    }
    const checkDup = billTemp.value.find((item) => item.dishId === dishDetail.value.id);
    if (checkDup && checkDup.cookingMethod === tempCookingMethod.value) {
        checkDup.quantity += tempQuantity.value;
        return;
    }
    billTemp.value.push({
        dishId: dishDetail.value.id,
        dishName: dishDetail.value.name,
        price: dishDetail.value.price,
        quantity: tempQuantity.value,
        cookingMethod: tempCookingMethod.value,
        note: tempNote.value
    });
    dishDetail.value = {};
    tempQuantity.value = 1;
    tempCookingMethod.value = "";
    tempNote.value = "";
}

function cookingMethodName(id, methodId) {
    if (methodId == "") return;
    const dish = menu.value.flatMap((item) => item.dishes).find((item) => item.id === id);
    const cookingMethod = dish.cookingMethods.find((item) => item.id === methodId);
    return cookingMethod.name;
}

function dishDelete(id) {
    const index = billTemp.value.find((item) => item.dishId === id);
    index.quantity--;
    if (index.quantity === 0) {
        billTemp.value = billTemp.value.filter((item) => item.dishId !== id);
    }
}

function tempTotal() {
    let total = 0;
    billTemp.value.forEach((item) => {
        total += item.price * item.quantity;
    });
    return total;
}

function showCart() {
    const cart = document.getElementById('cart');
    cart.showModal();
}

function formatPrice(price) {
    if (price == null) return;
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>